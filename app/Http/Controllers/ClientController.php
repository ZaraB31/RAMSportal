<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
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
}
