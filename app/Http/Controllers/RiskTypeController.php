<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiskType;

class RiskTypeController extends Controller
{
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
}