<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ProjectController extends Controller

{
    public function index ()
    {
        $names = DB::table ('projects')->select ('id', 'name')->where('user_id', Auth::id ())->get ();

        return view ('dashboard')->with ('names', $names);
    }

    public function create ()
    {
        $names = DB::table ('projects')->select ('id', 'name')->where('user_id', Auth::id ())->get ();

        $names = Crypt::encrypt($names);
        //dd(($encryptsNames));

        return view ('projects.create')->with ('names', $names);
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

    public function edit($id)
    {
        /*TODO Проверить при прямой подстановке*/

        //$currentRecord = DB::table ('projects')->select ('*')->where('user_id', Auth::id ())->get ();
        $currentRecord = Project::where ('id', $id)->where('user_id', Auth::id ())->get();

        //Заполняем леавое меню
        $names = DB::table ('projects')->select ('id', 'name')->where('user_id', Auth::id ())->get ();

        return view ('projects.edit', compact ('currentRecord'))->with ('names', $names);


    }

    public function update (Request $request, $id)
    {
        $Project = Project::find ($id);
        if ($request->isMethod ('PUT')) {

            $Project->name = $request->input ('name');
            $Project->save ();
        }
        return redirect ('dashboard');
    }


    public function destroy ($id) {
        $Project = new Project();
        Project::destroy($id);
        return redirect ('dashboard')
            ->with('name', $Project->name);
    }

}
