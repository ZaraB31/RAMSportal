<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ppe;

class PpeController extends Controller
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
            'name' => ['required', 'unique:ppes'],
        ]);

        $input = $request->all();
        $ppe = Ppe::create($input);

        return redirect()->route('adminPPE')->with('success', 'PPE added!');
    }
}
