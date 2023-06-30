<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiskType;

class RiskTypeController extends Controller
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
    
    public function store(Request $request) {
        $validatedData = $request->validate([
            'type' => ['required'],
        ], [
            'type.required' => 'The risk type is required',
        ]);

        $input = $request->all();
        $type = RiskType::create($input);

        return redirect()->route('adminRiskTypes')->with('success', 'Risk Type added!');
    }

    public function update($id, Request $request) {
        $riskType = RiskType::findOrFail($id);

        $riskType['name'] = $request['name'];
        $riskType->update();

        return redirect()->route('adminRiskTypes');
    }

    public function delete($id) {
        $type = RiskType::findOrFail($id);

        $type->delete();

        return redirect()->route('adminRiskTypes');
    }
}
