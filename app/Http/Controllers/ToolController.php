<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tool;

class ToolController extends Controller
{
    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => ['required', 'unique:tools'],
        ], [
            'name.required' => 'The tool name is requried',
            'name.unique' => 'This tool has already been added',
        ]);

        $input = $request->all();
        $tool = Tool::create($input);

        return redirect()->route('adminTools')->with('success', 'Tool added!');
    }
}
