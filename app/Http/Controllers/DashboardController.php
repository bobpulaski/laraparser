<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        //$names = Project::where('user_id', Auth::id ())->get(['user_id', 'id', 'name']);
        //dd($names);
        //return view('dashboard')->with('names', $names);
    }
}
