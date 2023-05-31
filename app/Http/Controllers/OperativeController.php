<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operative;
use App\Models\OperativeQualification;

class OperativeController extends Controller
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
            'name' => ['required', 'unique:operatives'],
            'profilePic' => ['required'],
            'phoneNo' => ['required', 'numeric', 'digits:11'],
            'position' => ['required'],
            'company_id' => ['required'],
        ], [
            'name.required' => 'An operative name is required',
            'name.unique' => 'This operative has already been saved',
            'profilePic.required' => 'A profile image is required',
            'phoneNo.required' => 'A phone number is required',
            'phoneNo.numeric' => 'The phone number must only be numeric values',
            'phoneNo.digits' => 'The phone number must be 11 numbers in length',
            'position.required' => 'A position title is required',
            'company_id.required' => 'A company is required',
        ]);

        $profile = $request->file('profilePic');
        $profileName = date('Y-m-d').'-'.$request['name'].'.'.$profile->getClientOriginalExtension();
        $target_path = public_path('/ProfilePictures');
        $profile->move($target_path, $profileName);

        $operative = Operative::create(['name' => $request['name'],
                                        'phoneNo' => $request['phoneNo'],
                                        'position' => $request['position'], 
                                        'profilePic' => $profileName,
                                        'company_id' => $request['company_id']]);

        foreach($request->get('qualification_id') as $qualification) {
            $operativeQualification = OperativeQualification::create([
                'operative_id' => $operative['id'],
                'qualification_id' => $qualification,
            ]);
        }

        return redirect()->route('adminOperatives')->with('success', 'Operative Added!');
    }
}
