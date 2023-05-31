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
use App\Models\Risk;
use App\Models\Method;
use App\Models\MethodPpe;
use App\Models\MethodTool;
use App\Models\Sequence;
use App\Models\Section;
use App\Models\ProjectRisk;
use App\Models\ProjectOperative;
use App\Models\Ammendment;
use App\Models\Qualification;
use App\Models\ProjectQualification;
use Auth;
use DB;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() {
        $projects = Project::all()->sortByDesc('created_at');
        $user = Auth::user();

        return view('projects/dashboard', ['projects' => $projects, 'user' => $user]);
    }

    public function createDetails() {
        $clients = Client::all()->sortBy('name');
        $hospitals = Hospital::all()->sortBy('name');
        $operatives = Operative::all()->sortBy('name');
        $qualifications = Qualification::all()->sortBy('name');

        return view('projects/createDetails', ['clients' => $clients,
                                               'hospitals' => $hospitals,
                                               'operatives' => $operatives,
                                               'qualifications' => $qualifications]);
    }

    public function storeDetails(Request $request) {
        $validatedData = $request->validate([
            'title' => ['required'],
            'jobNo' => ['required'],
            'client_id' => ['required'],
            'location' => ['required'],
            'start' => ['required', 'after_or_equal:today'],
            'end' => ['required'],
            'workingHours' => ['required'],
            'emergencyPhone' => ['required', 'numeric', 'digits:11'],
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
            'end.required' => 'The project end is requried',
            'workingHours.required' => 'The project working hours are required',
            'emergencyPhone.required' => 'An emergency phone number is required',
            'emergencyPhone.numeric' => 'The emergency phone number must only be numeric values',
            'emergencyPhone.digits' => 'The emergency phone number must be 11 numbers in length',
            'hospital_id.required' => 'The nearest A&E to the project site is requried',
            'supervisor_id.requried' => 'The project supervisor is requried',
            'manager_id.requried' => 'The project manager is requried',
        ]);

        if ($validatedData->fails()) {
            return redirect('projects/createDetails')->withErrors($validatedData)->withInput();
        }

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
            'end' => $request['end'],
            'workingHours' => $request['workingHours'],
            'hospital_id' => $request['hospital_id'],
            'supervisor_id' => $request['supervisor_id'],
            'manager_id' => $request['manager_id'],
            'emergencyPhone' => $request['emergencyPhone'],
        ]);

        foreach($request->get('operative_id') as $operative) {
            $projectOperatives = ProjectOperative::create([
                'project_id' => $project['id'],
                'operative_id' => $operative,
            ]);
        }
        
        foreach($request->get('qualifications') as $qualification) {
            $projectQualification = ProjectQualification::create([
                'project_id' => $project['id'],
                'qualification_id' => $qualification,
            ]);
        } 

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

    public function storeMethod(Request $request, $id) {
        $project = Project::findOrFail($id);

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

    public function storeRisks(Request $request, $id) {
        $risks = [];

        foreach($request->get('projectRisks') as $riskID) {
            array_push($risks, $riskID);
        }

        $risks = array_unique($risks);

        foreach($risks as $risk) {
            $projectRisk = ProjectRisk::create([
                'project_id' => $id,
                'risk_id' => $risk,
            ]);
        }

        return redirect()->route('showProject', $id);
    }

    public function show($id) {
        $project = Project::findOrFail($id);
        $userID = Auth::id();
        $versions = Ammendment::where('project_id', $id)->get()->sortByDesc('version');

        $risks = $project->risk()->get();

        $before = [];
        $after = [];

        foreach($risks as $risk) {
            $before[$risk['id']] = $risk['likelihood'] * $risk['severity'];
            $after[$risk['id']] = $risk['residualLikelihood'] * $risk['residualSeverity'];
        }

        return view('projects/show', ['project' => $project,
                                      'before' => $before,
                                      'after' => $after,
                                      'userID' => $userID,
                                      'versions' => $versions]);
    }

    public function download($id, $version) {
        $project = Project::findOrFail($id);
        $fileVersion = Ammendment::where('project_id', $id)->where('version', $version)->first();

        $filePath = public_path('/pdf/'.$fileVersion['fileName']);

        return Response()->download($filePath);
    }

    public function edit($id) {
        $project = Project::findOrFail($id);
        $hospitals = Hospital::all();
        $operatives = Operative::all()->sortBy('name');

        $projectPeople = ProjectOperative::where('project_id', $id)->get();
        $projectOperatives = [];
        foreach($projectPeople as $projectPerson) {
            array_push($projectOperatives, $projectPerson['operative_id']);
        }

        $sequenceSteps = Sequence::where('method_id', $project->method['id'])->get()->sortBy('stepNo');
        $tools = Tool::all()->sortBy('name');
        $PPEs = Ppe::all()->sortBy('name');
        $qualifications = Qualification::all()->sortBy('name');

        $projectQualifications = ProjectQualification::where('project_id', $id)->get();
        $proQualifications = [];
        foreach($projectQualifications as $qualification) {
            array_push($proQualifications, $qualification['qualification_id']);
        }

        $methodPPEs = MethodPpe::where('method_id', $project->method['id'])->get();
        $projectPPEs = [];
        foreach($methodPPEs as $methodPPE) {
            array_push($projectPPEs, $methodPPE['ppe_id']);
        }

        $methodTools = MethodTool::where('method_id', $project->method['id'])->get();
        $projectTools = [];
        foreach($methodTools as $methodTool) {
            array_push($projectTools, $methodTool['tool_id']);
        }
        
        $sections = Section::all();
        $proRisks = ProjectRisk::where('project_id', $id)->get();
        $projectRisks = [];
        foreach($proRisks as $proRisk) {
            array_push($projectRisks, $proRisk['risk_id']);
        }

        return view('projects/edit', compact('project', 
                                             'hospitals',
                                             'operatives',
                                             'sequenceSteps',
                                             'tools',
                                             'PPEs',
                                             'projectPPEs',
                                             'projectTools',
                                             'projectOperatives',
                                             'sections',
                                             'projectRisks',
                                             'qualifications', 
                                             'proQualifications'));
    }

    public function update($id, Request $request) {
        $project = Project::findOrFail($id);

        $project['jobNo'] = $request['jobNo'];
        $project->update();

        $projectDetails = [
            'location' => $request['location'],
            'start' => $request['start'],
            'end' => $request['end'],
            'workingHours' => $request['workingHours'],
            'hospital_id' => $request['hospital_id'],
            'supervisor_id' => $request['supervisor_id'],
            'manager_id' => $request['manager_id'],
        ];
        $details = Detail::where('project_id', $id)->update($projectDetails);

        DB::table('project_operatives')->where('project_id', $id)->delete();
        foreach($request->get('operative') as $operative) {
            $projectOperatives = ProjectOperative::create([
                'project_id' => $id,
                'operative_id' => $operative,
            ]);
        }

        DB::table('project_qualifications')->where('project_id', $id)->delete();
        foreach($request->get('qualification') as $qualification) {
            $projectQualification = ProjectQualification::create([
                'project_id' => $project['id'],
                'qualification_id' => $qualification,
            ]);
        } 

        $projectMethod = [
            'description' => $request['description'],
        ];
        $method = Method::where('project_id', $id)->first();
        $method->update($projectMethod);

        
        DB::table('sequences')->where('method_id', $method['id'])->delete();
        $sequenceSteps = $request->get('sequenceStep');
        for($i = 0; $i < count($sequenceSteps); $i++) {
            if($sequenceSteps[$i] !== null) {
                $sequence = Sequence::create([
                'stepNo' => $i+1,
                'description' => $sequenceSteps[$i],
                'method_id' => $method['id'],
                ]);
            }
        }

        DB::table('method_tools')->where('method_id', $method['id'])->delete();
        foreach($request->get('tools') as $tool) {
            $methodTools = MethodTool::create([
                'method_id' => $method['id'],
                'tool_id' => $tool,
            ]);
        }

        DB::table('method_PPEs')->where('method_id', $method['id'])->delete();
        foreach($request->get('PPEs') as $PPE) {
            $methodPPEs = MethodPpe::create([
                'method_id' => $method['id'],
                'ppe_id' => $PPE,
            ]);
        }

        DB::table('project_risks')->where('project_id', $id)->delete();
        $risks = [];
        foreach($request->get('projectRisks') as $riskID) {
            array_push($risks, $riskID);
        }
        $risks = array_unique($risks);
        foreach($risks as $risk) {
            $projectRisk = ProjectRisk::create([
                'project_id' => $id,
                'risk_id' => $risk,
            ]);
        }

        $ammendments = Ammendment::where('project_id', $id)->get();
        $latestAmmendment = $ammendments->last();
        $latestVersion = $latestAmmendment['version'] + 1;

        $newAmmendment = Ammendment::create([
            'project_id' => $id,
            'version' => $latestVersion,
            'comment' => $request['comment'],
        ]);

        $fileName = (new PDFController)->generateRAMS($id, $newAmmendment['version']);

        $newAmmendment['fileName'] = $fileName;
        $newAmmendment->save();

        return redirect()->route('showProject', $id)->with('success', 'Project Updated!');
    }
}
