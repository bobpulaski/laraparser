<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller

{
    public function index()
    {
        $currentRecord = Project::where('user_id', Auth::id())->get();

        $names = DB::table('projects')->select('id', 'name')->where('user_id', Auth::id())->get();

        $chapters = DB::table ('chapters')->select ('id', 'project_id', 'user_id', 'name')->where('user_id', Auth::id())->get();
        //dd($chapters);

        return view('dashboard', compact('currentRecord'))->with('names', $names)->with ('chapters', $chapters);
    }

    public function create()
    {
        $names = DB::table('projects')->select('id', 'name')->where('user_id', Auth::id())->get();
        $currentRecord = Project::where('user_id', Auth::id())->get();
        $chapters = DB::table ('chapters')->select ('id', 'project_id', 'user_id', 'name')->where('user_id', Auth::id())->get();
        return view('projects.create', compact('currentRecord'))->with('names', $names)->with ('chapters', $chapters);
    }

    public function store(Request $request)
    {

        $request->validate([
            'item_name' => 'required|max:20',
        ]);

        $Project = new Project();
        $Project->user_id = Auth::id();
        $Project->name = $request->input('item_name');
        $Project->save();

        return redirect('dashboard')
            ->with('success', 'Проект ' . $Project->name . ' добавлен.');
    }

    public function edit($id)
    {
        /*TODO Проверить при прямой подстановке*/

        //$currentRecord = DB::table ('projects')->select ('*')->where('user_id', Auth::id ())->get ();
        $currentRecord = Project::where('id', $id)->where('user_id', Auth::id())->get();

        //Заполняем левое меню
        $names = DB::table('projects')->select('id', 'name')->where('user_id', Auth::id())->get();

        return view('projects.edit', compact('currentRecord'))->with('names', $names);


    }

    public function update(Request $request, $id)
    {
        $Project = Project::find($id);
        if ($request->isMethod('PUT')) {

            $Project->name = $request->input('name');
            $Project->save();
        }
        return redirect('dashboard');
    }


    public function destroy($id)
    {
        $Project = new Project();
        Project::destroy($id);
        return redirect('dashboard')
            ->with('name', $Project->name);
    }

}
