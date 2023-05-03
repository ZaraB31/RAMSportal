<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectRisk;
use App\Models\Risk;
use App\Models\ProjectOperative;
use PDF;

class PDFController extends Controller
{
    public function generateRAMS($id) {
        $project = Project::findOrFail($id);

        $before = [];
        $after = [];

        foreach($project->risk as $risk) {
            $before[$risk['id']] = $risk['likelihood'] * $risk['severity'];
            $after[$risk['id']] = $risk['residualLikelihood'] * $risk['residualSeverity'];
        }

        $projectOperatives = ProjectOperative::where('project_id', $id);
        $operatives = $projectOperatives->count();

        $start = date_create($project->detail['start']);
        $end = date_create($project->detail['end']);
        $diff = date_diff($start, $end);
        $days = $diff->format('%d');

        $data = [
            'project' => $project,
            'before' => $before,
            'after' => $after,
            'operatives' => $operatives,
            'days' => $days,
        ];

        $RAMS = PDF::loadView('pdfs/rams', $data);

        // return view('pdfs/rams', ['project' => $project, 
        //                     'before' => $before,
        //                     'after' => $after,
        //                     'operatives' => $operatives,
        //                     'days' => $days,
        // ]);
                            
        return $RAMS->download('test.pdf');
    }

    public function generateDailyRA($id) {
        $project = Project::findOrFail($id);

    }
}
