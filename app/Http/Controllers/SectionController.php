<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;

class SectionController extends Controller
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
            'name' => ['required'],
        ], [
            'name.required' => 'The section name is required',
        ]);

        $input = $request->all();
        $section = Section::create($input);

        return redirect()->route('adminSections')->with('success', 'Section added!');
    }

    public function delete($id) {
        $section = Section::findOrFail($id);

        $section->delete();

        return redirect()->route('adminSections');
    }
}
