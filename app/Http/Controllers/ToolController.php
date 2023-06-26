<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tool;

class ToolController extends Controller
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
            'name' => ['required', 'unique:tools'],
        ], [
            'name.required' => 'The tool name is requried',
            'name.unique' => 'This tool has already been added',
        ]);

        $input = $request->all();
        $tool = Tool::create($input);

        return redirect()->route('adminTools')->with('success', 'Tool added!');
    }

    public function delete($id) {
        $tool = Tool::findOrFail($id);

        $tool->delete();

        return redirect()->route('adminTools');
    }
}
