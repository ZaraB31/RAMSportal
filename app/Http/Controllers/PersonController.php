<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;

class PersonController extends Controller
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
            'person' => ['required', 'unique:people'],
        ], [
            'person.required' => 'The people at risk name is required',
            'person.unique' => 'This at risk name has already been added',
        ]);

        $input = $request->all();
        $person = Person::create($input);

        return redirect()->route('adminPeople')->with('success', 'People at Risk added!');
    }

    public function update($id, Request $request) {
        $person = Person::findOrFail($id);

        $person['person'] = $request['person'];
        $person->update();

        return redirect()->route('adminPersons');
    }

    public function delete($id) {
        $person = Person::findOrFail($id);

        $person->delete();

        return redirect()->route('adminPeople');
    }
}
