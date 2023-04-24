<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ppe;

class PpeController extends Controller
{
    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => ['required', 'unique:ppes'],
            'icon' => ['required'],
        ]);

        $icon = $request->file('icon');
        $iconName = date('Y-m-d').'-'.$request['name'].'.'.$icon->getClientOriginalExtension();
        $target_path = public_path('/PPE');
        $icon->move($target_path, $iconName);

        $PPE = Ppe::create([
            'name' => $request['name'],
            'icon' => $iconName,
        ]);

        return redirect()->route('adminPPE')->with('success', 'PPE added!');
    }
}
