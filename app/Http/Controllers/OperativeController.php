<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operative;
use App\Models\Company;
use File;

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

        if($request['profilePic'] !== null) {
            $profile = $request->file('profilePic');
            $profileName = date('Y-m-d').'-'.$request['name'].'.'.$profile->getClientOriginalExtension();
            $target_path = public_path('/ProfilePictures');
            $profile->move($target_path, $profileName);
        } else {
            $profileName = "placeholderOperative.png";
        }
        

        $operative = Operative::create(['name' => $request['name'],
                                        'phoneNo' => $request['phoneNo'],
                                        'position' => $request['position'], 
                                        'profilePic' => $profileName,
                                        'company_id' => $request['company_id']]);

        return redirect()->route('adminOperatives')->with('success', 'Operative Added!');
    }

    public function edit($id) {
        $operative = Operative::findOrFail($id);
        $companies = Company::all();

        return view('admin/editOperative', ['operative' => $operative, 'companies' => $companies]);
    }

    public function update(Request $request, $id) {
        $operative = Operative::findOrFail($id);

        if($request['profilePic'] === null) {
            $profileName = $operative['profilePic'];
        } else {
            $profile = $request->file('profilePic');
            $profileName = date('Y-m-d').'-'.$request['name'].'.'.$profile->getClientOriginalExtension();
            $target_path = public_path('/ProfilePictures');
            $profile->move($target_path, $profileName);
        }

        $operative['name'] = $request['name'];
        $operative['phoneNo'] = $request['phoneNo'];
        $operative['profilePic'] = $profileName;
        $operative['position'] = $request['position'];
        $operative['company_id'] = $request['company_id'];
        $operative->update();

        return redirect()->route('adminOperatives', $id)->with('success', 'Operative Updated!');
    }

    public function delete($id) {
        $operative = Operative::findOrFail($id);

        $deletedImage = File::delete(public_path().'/ProfilePictures/'.$operative->profilePic);
        $operative->delete();

        return redirect()->route('adminOperatives');
    }
}
