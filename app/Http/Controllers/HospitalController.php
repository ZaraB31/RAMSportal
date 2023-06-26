<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;

class HospitalController extends Controller
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
            'name' => ['required', 'unique:hospitals'],
            'address' => ['required'],
        ], [
            'name.required' => 'The hospital name is required', 
            'name.unique' => 'This hospital has already been saved',
            'address.required' => 'The hosital address is required',
        ]);

        $input = $request->all();
        $hospital = Hospital::create($input);

        return redirect()->route('adminHospitals')->with('success', 'Hospital added!');
    }

    public function delete($id) {
        $hospital = findOrFail($id);

        $hospital->delete();

        return redirect()->route('adminHospitals');
    }
}
