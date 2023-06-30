<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
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
            'name' => ['required', 'unique:clients'],
        ], [
            'name.required' => 'A company name is required',
            'name.unqiue' => 'This client has already been added',
        ]);

        $input = $request->all();
        $client = Client::create($input);

        return redirect()->route('adminClients')->with('success', 'Client Added!');
    }

    public function update($id, Request $request) {
        $client = Client::findOrFail($id);

        $client['name'] = $request['name'];
        $client->update();

        return redirect()->route('adminClients');
    }

    public function delete($id) {
        $client = Client::findOrFail($id);

        $client->delete();

        return redirect()->route('adminClients');
    }
}
