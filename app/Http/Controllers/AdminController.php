<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\User;
use App\Models\Client;
use App\Models\Operative;
use App\Models\Hospital;

class AdminController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin/dashboard');
    }

    public function users() {
        $users = User::all()->sortBy('name');
        $companies = Company::all();

        return view('admin/users', ['users' => $users, 'companies' => $companies]);
    }

    public function companies() {
        $companies = Company::all();
        
        return view('admin/companies', ['companies' => $companies]);
    }

    public function clients() {
        $clients = Client::all()->sortBy('name');

        return view('admin/clients', ['clients' => $clients]);
    }

    public function operatives() {
        $operatives = Operative::all()->sortBy('name');
        $companies = Company::all();

        return view('admin/operatives', ['operatives' => $operatives, 'companies' => $companies]);
    }

    public function hospitals() {
        $hospitals = Hospital::all();

        return view('admin/hospitals', ['hospitals' => $hospitals]);
    }
}
