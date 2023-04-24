<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;

class SectionController extends Controller
{
    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => ['required'],
            'type' => ['required'],
        ], [
            'name.required' => 'The section name is required',
            'type.required' => 'the section type is required',
        ]);

        $input = $request->all();
        $section = Section::create($input);

        return redirect()->route('adminSections')->with('success', 'Section added!');
    }
}
