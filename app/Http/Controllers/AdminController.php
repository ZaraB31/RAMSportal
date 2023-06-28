<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\User;
use App\Models\Client;
use App\Models\Operative;
use App\Models\Hospital;
use App\Models\Ppe;
use App\Models\Section;
use App\Models\Tool;
use App\Models\Person;
use App\Models\RiskType;
use App\Models\Risk;
use App\Models\Qualification;
use DB;

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
    public function index() {
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

    public function clients(Request $request) {
        $clients = DB::table('clients')->paginate(8);

        if($request->ajax()) {
            return view('admin/clients', ['clients' => $clients])->render();
        }

        return view('admin/clients', ['clients' => $clients]);
    }

    public function operatives() {
        $operatives = Operative::all()->sortBy('name');
        $companies = Company::all();
        $qualifications = Qualification::all()->sortBy('name');

        return view('admin/operatives', ['operatives' => $operatives, 
                                         'companies' => $companies,
                                         'qualifications' => $qualifications]);
    }

    public function hospitals() {
        $hospitals = Hospital::all();

        return view('admin/hospitals', ['hospitals' => $hospitals]);
    }

    public function PPEs(Request $request) {
        $PPEs = DB::table('ppes')->orderBy('name')->paginate(8);

        if($request->ajax()) {
            return view('admin/PPEs', ['PPEs' => $PPEs])->render();
        }

        return view('admin/PPEs', ['PPEs' => $PPEs]);
    }

    public function sections(Request $request) {
        $sections = DB::table('sections')->orderBy('name')->paginate(8);

        if($request->ajax()) {
            return view('admin/sections', ['sections' => $sections])->render();
        }

        return view('admin/sections', ['sections' => $sections]);
    }

    public function tools(Request $request) {
        $tools = DB::table('tools')->orderBy('name')->paginate(8);

        if($request->ajax()) {
            return view('admin/tools', ['tools' => $tools])->render();
        }

        return view('admin/tools', ['tools' => $tools]);
    }

    public function people() {
        $people = Person::all();

        return view('admin/people', ['people' => $people]);
    }

    public function riskTypes() {
        $types = RiskType::all()->sortBy('type');

        return view('admin/riskTypes', ['types' => $types]);
    }

    public function risks() {
        $sections = Section::all();
        $risks = Risk::all();

        $before = [];
        $after = [];

        foreach($risks as $risk) {
            $before[$risk['id']] = $risk['likelihood'] * $risk['severity'];
            $after[$risk['id']] = $risk['residualLikelihood'] * $risk['residualSeverity'];
        }

        return view('admin/risks', ['risks' => $risks,
                                    'sections' => $sections, 
                                    'before' => $before,
                                    'after' => $after]);
    }

    public function qualifications(Request $request) {
        $qualifications = DB::table('qualifications')->orderBy('name')->paginate(8);

        if($request->ajax()) {
            return view('admin/qualifications', ['qualifications' => $qualifications])->render();
        }

        return view('admin/qualifications', ['qualifications' => $qualifications]);
    }
}
