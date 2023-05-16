<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Qualification;

class QualificationController extends Controller
{
    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => ['required', 'unique:qualifications'],
        ], [
            'name.required' => 'The qualification name is required',
            'name.unique' => 'This qualification has already been added',
        ]);

        $input = $request->all();
        $qualification = Qualification::create($input);

        return redirect()->route('adminQualifications')->with('success', 'Qualification added!');
    }
}
