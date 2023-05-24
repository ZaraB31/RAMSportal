<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;
use App\Models\Project;
use App\Models\ProjectRisk;
use App\Models\Risk;
use App\Models\ProjectOperative;
use App\Models\RiskType;
use App\Models\Ammendment;
use PDF;

class PDFController extends Controller
{
    public function generateRAMS($id, $version) {
        $project = Project::findOrFail($id);
        $types = [];

        $ammendments = Ammendment::where('project_id', $id)->get();
        $latestAmmendment = $ammendments->last();

        $before = [];
        $after = [];

        foreach($project->risk as $risk) {
            $before[$risk['id']] = $risk['likelihood'] * $risk['severity'];
            $after[$risk['id']] = $risk['residualLikelihood'] * $risk['residualSeverity'];
        }

        foreach($project->risk as $risk) {
            $type = $risk->type->type;
            array_push($types, $type);
        }
        $types = array_unique($types);

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
            'types' => $types,
            'latestAmmendment' => $latestAmmendment,
        ];

        $methodStatement = PDF::loadView('pdfs/methodStatement', $data)->setPaper('a4', 'portrait')->save('../public/components/method-'.$id.'.pdf');
        $riskAssesment = PDF::loadView('pdfs/riskAssessment', $data)->setPaper('a4', 'landscape')->save('../public/components/risks-'.$id.'.pdf');
        $dailyRA = PDF::loadView('pdfs/dailyRA', $data)->setPaper('a4', 'portrait')->save('../public/components/daily-'.$id.'.pdf');

        $pdf = PDFMerger::init();
        $pdf->addPDF(base_path('public/components/method-'.$id.'.pdf'), 'all');
        $pdf->addPDF(base_path('public/components/risks-'.$id.'.pdf'), 'all');
        $pdf->addPDF(base_path('public/components/daily-'.$id.'.pdf'), 'all');
        $pdf->merge();

        $fileName = $project['title'] . ' - V' . $version . '.pdf';
        $filePath = '../public/pdf/' . $fileName;

        $pdf->save($filePath, "file");
        

        // return view('pdfs/rams', ['project' => $project, 
        //                     'before' => $before,
        //                     'after' => $after,
        //                     'operatives' => $operatives,
        //                     'days' => $days,
        //                     'types' => $types,
        //                     'latestAmmendment' => $latestAmmendment,
        // ]);
        
        return $fileName;
    }
}
