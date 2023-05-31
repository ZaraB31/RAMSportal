<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
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
            'name' => ['required', 'unique:companies'],
            'phoneNo' => ['required', 'numeric', 'digits:11'],
            'email' => ['required'],
            'address' => ['required'],
        ], [
            'name.required' => 'A company name is required',
            'name.unique' => 'This company has already been saved',
            'phoneNo.required' => 'A phone number is required',
            'phoneNo.numeric' => 'The phone number must only be numeric values',
            'phoneNo.digits' => 'The phone number must be 11 numbers in length',
            'email.required' => 'A company email address is required',
            'email.address' => 'A company site address is required',
        ]);

        $input = $request->all();
        Company::create($input);
        
        return redirect('Admin/Companies')->with('success', 'Company added!');
    }
}
