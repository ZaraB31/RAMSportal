<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Client;
use App\Models\Hospital;
use App\Models\Operative;
use App\Models\Company;
use App\Models\Detail;
use App\Models\Ppe;
use App\Models\Tool;
use App\Models\Method;
use App\Models\MethodPpe;
use App\Models\MethodTool;
use App\Models\Sequence;
use App\Models\Section;
use App\Models\ProjectRisk;
use Auth;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() {
        $projects = Project::all();

        return view('projects/dashboard', ['projects' => $projects]);
    }

    public function createDetails() {
        $clients = Client::all()->sortBy('name');
        $hospitals = Hospital::all()->sortBy('name');
        $operatives = Operative::all()->sortBy('name');

        return view('projects/createDetails', ['clients' => $clients,
                                               'hospitals' => $hospitals,
                                               'operatives' => $operatives]);
    }

    public function storeDetails(Request $request) {
        $validatedData = $request->validate([
            'title' => ['required'],
            'jobNo' => ['required'],
            'client_id' => ['required'],
            'location' => ['required'],
            'start' => ['required', 'after_or_equal:today'],
            'duration' => ['required'],
            'workingHours' => ['required'],
            'hospital_id' => ['required'],
            'supervisor_id' => ['required'],
            'manager_id' => ['required'],
        ], [
            'title.requried' => 'The project title is required',
            'jobNo' => 'The project job number is requried',
            'client_id.required' => 'The project client is required',
            'location' => 'The project site address is requried', 
            'start.required' => 'The project start date is required',
            'start.after_or_equal' => 'The project start date must not be in the past',
            'duration.required' => 'The project duration is requried',
            'workingHours.required' => 'The project working hours are required',
            'hospital_id.required' => 'The nearest A&E to the project site is requried',
            'supervisor_id.requried' => 'The project supervisor is requried',
            'manager_id.requried' => 'The project manager is requried',
        ]);

        $user = Auth()->user();
        $company = Company::find($user['company_id'])->first();

        $project = Project::create([
            'title' => $request['title'],
            'jobNo' => $request['jobNo'],
            'client_id' => $request['client_id'],
            'user_id' => $user['id'],
            'company_id' => $company['id'],
        ]);

        $details = Detail::create([
            'project_id' => $project['id'],
            'location' => $request['location'],
            'start' => $request['start'],
            'duration' => $request['duration'],
            'workingHours' => $request['workingHours'],
            'hospital_id' => $request['hospital_id'],
            'supervisor_id' => $request['supervisor_id'],
            'manager_id' => $request['manager_id'],
        ]);

        return redirect()->route('createProjectMethod', $project['id']);
    } 

    public function createMethod($id) {
        $project = Project::findOrFail($id);
        $PPEs = Ppe::all()->sortBy('name');
        $tools = Tool::all()->sortBy('name');

        return view('projects/createMethod', ['project' => $project,
                                              'PPEs' => $PPEs,
                                              'tools' => $tools]);
    }

    public function storeMethod(Request $request) {
        $project = Project::find($request['project_id'])->first();

        $validateData = $request->validate([
            'description' => ['required'],
        ], [
            'description.required' => 'The project descripition is required',
        ]);

        $method = Method::create([
            'description' => $request['description'],
            'project_id' => $project['id'],
        ]);

        foreach($request->get('ppe_id') as $ppeID) {
            $methodPPE = MethodPpe::create([
                'method_id' => $method['id'],
                'ppe_id' => $ppeID,
            ]);
        }

        foreach($request->get('tool_id') as $toolID) {
            $methodTool = MethodTool::create([
                'method_id' => $method['id'],
                'tool_id' => $toolID,
            ]);
        }

        $sequenceSteps = $request->get('sequenceStep');

        for($i = 0; $i < count($sequenceSteps); $i++) {
            $sequence = Sequence::create([
                'stepNo' => $i+1,
                'description' => $sequenceSteps[$i],
                'method_id' => $method['id'],
            ]);
        }

        return redirect()->route('createProjectRisks', $project['id']);
    }

    public function createRisks($id) {
        $project = Project::findOrFail($id);
        $sections = Section::where('type', 'risks')->get();

        return view('projects/createRisks', ['project' => $project, 'sections' => $sections]);
    }

    public function storeRisks(Request $request) {
        $risks = [];

        foreach($request->get('projectRisks') as $riskID) {
            array_push($risks, $riskID);
        }

        $risks = array_unique($risks);

        foreach($risks as $risk) {
            $projectRisk = ProjectRisk::create([
                'project_id' => $request['project_id'],
                'risk_id' => $risk,
            ]);
        }

        return redirect()->route('showProject', $request['project_id']);
    }

    public function show($id) {
        $project = Project::findOrFail($id);

        return view('projects/show', ['project' => $project]);
    }
}
