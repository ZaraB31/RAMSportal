<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Risk;
use App\Models\Person;
use App\Models\Section;
use App\Models\RiskSection;

class RiskController extends Controller
{
    public function create() {
        $people = Person::all();
        $sections = Section::where('type', 'risks')->get();

        return view('admin/risksCreate', ['people' => $people,
                                          'sections' => $sections]);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'hazard' => ['required'],
            'effect' => ['required'],
            'likelihood' => ['required'],
            'severity' => ['required'],
            'control' => ['required'],
            'residualLikelihood' => ['required'],
            'residualSeverity' => ['required'],
            'person_id' => ['required'],
        ], [
            'hazard.required' => 'The risk hazard is required',
            'effect.required' => 'The risk effect is required',
            'likelihood.required' => 'The risk likelihood is required',
            'severity.required' => 'The risk severity is required',
            'control.required' => 'The risk control measures is required',
            'residualLikelihood.required' => 'The risk residual likelihood is required',
            'residualSeverity.required' => 'The risk residual severity is required',
            'person_id.required' => 'The people at risk field is required',
        ]);

        $risk = Risk::create([
            'hazard' => $request['hazard'],
            'effect' => $request['effect'],
            'likelihood' => $request['likelihood'],
            'severity' => $request['severity'],
            'person_id' => $request['person_id'],
            'control' => $request['control'],
            'residualLikelihood' => $request['residualLikelihood'],
            'residualSeverity' => $request['residualSeverity'],
        ]);

        foreach($request->get('sections') as $sectionID) {
            $riskSections = RiskSection::create([
                'risk_id' => $risk['id'],
                'section_id' => $sectionID,
            ]);
        }

        return redirect()->route('adminRisks')->with('success', 'Risk added!');
    }
}
