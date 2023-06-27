<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Client;
use App\Models\Company;

class SearchController extends Controller
{
    public function index() {
        return view('search');
    }

    public function searchTitle(Request $request) {
        $projectsArray = [];

        if($request->keyword !== '') {
            $projects = Project::where('title', 'LIKE', '%'.$request->keyword.'%')->get()->sortBy('created_at');

            foreach($projects as $project) {
                array_push($projectsArray, ['projectID' => $project['id'], 
                                            'name' => $project['title'], 
                                            'client' => $project->client['name'],
                                            'company' => $project->company['name']]);
            }

            return response()->json([
                'projects' => $projectsArray
            ]);
        }

    }

    public function searchClient(Request $request) {
        $projectsArray = [];
        $projects = [];

        if($request->keyword !== '') {
            $clients = Client::where('name', 'LIKE', '%'.$request->keyword.'%')->get();

            foreach($clients as $client) {
                $clientProjects = Project::where('client_id', $client['id'])->get();
                foreach($clientProjects as $clientProject) {
                    array_push($projects, $clientProject);
                }
            }


            foreach($projects as $project) {
                array_push($projectsArray, ['projectID' => $project['id'], 
                                            'name' => $project['title'], 
                                            'client' => $project->client['name'],
                                            'company' => $project->company['name']]);
            }

            return response()->json([
                'projects' => $projectsArray
            ]);
        }

    }

    public function searchCompany(Request $request) {
        $projectsArray = [];
        $projects = [];

        if($request->keyword !== '') {
            $companys = Company::where('name', 'LIKE', '%'.$request->keyword.'%')->get();

            foreach($companys as $company) {
                $companyProjects = Project::where('company_id', $company['id'])->get();
                foreach($companyProjects as $companyProject) {
                    array_push($projects, $companyProject);
                }
            }


            foreach($projects as $project) {
                array_push($projectsArray, ['projectID' => $project['id'], 
                                            'name' => $project['title'], 
                                            'client' => $project->client['name'],
                                            'company' => $project->company['name']]);
            }

            return response()->json([
                'projects' => $projectsArray
            ]);
        }

    }
}
