<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class SearchController extends Controller
{
    public function index() {
        return view('search');
    }

    public function search(Request $request) {
        $projectsArray = [];

        if($request->keyword !== '') {
            $projects = Project::where('title', 'LIKE', '%'.$request->keyword.'%')->get();

            foreach($projects as $project) {
                array_push($projectsArray, ['projectID' => $project['id'], 'name' => $project['title']]);
            }

            return response()->json([
                'projects' => $projectsArray
            ]);
        }

    }
}
