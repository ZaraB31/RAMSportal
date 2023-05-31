<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Risk;
use App\Models\Person;
use App\Models\Section;
use App\Models\RiskSection;
use App\Models\RiskType;

class RiskController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create() {
        $people = Person::all();
        $sections = Section::all()->sortBy('name');
        $types = RiskType::all()->sortBy('type');

        return view('admin/risksCreate', ['people' => $people,
                                          'sections' => $sections,
                                          'types' => $types]);
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
            'type_id' => ['required'],
        ], [
            'hazard.required' => 'The risk hazard is required',
            'effect.required' => 'The risk effect is required',
            'likelihood.required' => 'The risk likelihood is required',
            'severity.required' => 'The risk severity is required',
            'control.required' => 'The risk control measures is required',
            'residualLikelihood.required' => 'The risk residual likelihood is required',
            'residualSeverity.required' => 'The risk residual severity is required',
            'person_id.required' => 'The people at risk field is required',
            'type_id.required' => 'The risk type is required',
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
            'type_id' => $request['type_id'],
        ]);

        foreach($request->get('sections') as $sectionID) {
            $riskSections = RiskSection::create([
                'risk_id' => $risk['id'],
                'section_id' => $sectionID,
            ]);
        }

        return redirect()->route('adminRisks')->with('success', 'Risk added!');
    }

    public function edit($id) {
        $risk = Risk::findOrFail($id);
        $people = Person::all();

        $sections = Section::all()->sortBy('name');
        $riskSectionIds = [];
        $riskSections = RiskSection::where('risk_id', $id)->get();
        foreach($riskSections as $riskSection) {
            array_push($riskSectionIds, $riskSection->section_id);
        }

        $types = RiskType::all()->sortBy('type');

        return view('admin/editRisk', ['risk' => $risk,
                                       'people' => $people,
                                       'sections' => $sections,
                                       'types' => $types,
                                       'riskSectionIds' => $riskSectionIds]);
    }

    public function update(Request $request, $id) {
        $risk = Risk::FindOrFail($id);

        $input = $request->all();
        $risk->update($input);
        $risk->save();

        $sections = RiskSection::where('risk_id', $id)->delete();
        foreach($request->get('sections') as $sectionID) {
            $riskSections = RiskSection::create([
                'risk_id' => $risk['id'],
                'section_id' => $sectionID,
            ]);
        }

        return redirect()->route('adminRisks')->with('success', 'Risk Updated!');
    }
}
