<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index() {
        $names = DB::table('projects')->select('id','name')->get();
        return view('dashboard')->with('names', $names);
    }
}
