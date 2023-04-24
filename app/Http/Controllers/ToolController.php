<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tool;

class ToolController extends Controller
{
    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => ['required', 'unique:tools'],
            'section_id' => ['required'],
        ], [
            'name.required' => 'The tool name is requried',
            'name.unique' => 'This tool has already been added',
            'section_id.required' => 'The tool section is required',
        ]);

        $input = $request->all();
        $tool = Tool::create($input);

        return redirect()->route('adminTools')->with('success', 'Tool added!');
    }
}
