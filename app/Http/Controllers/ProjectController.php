<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller

{
    public function index ()
    {
        $names = DB::table ('projects')->select ('id', 'name')->where('user_id', Auth::id ())->get ();
        return view ('dashboard')->with ('names', $names);
    }

    public function add ()
    {

        $names = DB::table ('projects')->select ('id', 'name')->where('user_id', Auth::id ())->get ();
        return view ('add-new-project')->with ('names', $names);

    }

    public function store (Request $request)
    {

        $request->validate ([
            'item_name' => 'required|max:15',
        ]);

        $Project = new Project();
        $Project->user_id = Auth::id ();
        $Project->name = $request->input ('item_name');
        $Project->save ();

        return redirect ('dashboard')
            ->with ('success', 'Проект ' . $Project->name . ' добавлен.');
    }

    public function destroy ($id) {
        $Project = new Project();
        Project::destroy($id);
        return redirect ('dashboard')
            ->with('name', $Project->name);
    }

}
