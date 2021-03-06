<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Project;
use App\Models\Qprogress;
use App\Models\Rule;
use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        session(['ProjectMenuTabIdKey' => $request->get('project')]); //Храним в сессии, чтобы меню запоминало позицию

        $ProjectMenuTabIdKey = $request->session()->get('ProjectMenuTabIdKey'); //Получаем из сессии id вкладки проекта

        $project = Project::where('user_id', Auth::id())
            ->where('id', $ProjectMenuTabIdKey)
            ->firstOrFail();


        $projectsMenuItems = $request->get('projectsMenuItems'); //Фомрируем меню. Получаем данные для меню из middleware, которые от-туда содержаться в запросе
        $chaptersMenuItems = $request->get('chaptersMenuItems');


        return response(view('chapters.create')
            ->with('projectsMenuItems', $projectsMenuItems)
            ->with('chaptersMenuItems', $chaptersMenuItems)
            ->with(compact('project')));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        //TODO Возвращать введенное значение

        $request->validate([
            'item_name' => 'required|max:25',
        ]);

        $Chapter = new Chapter();

        $Chapter->user_id = Auth::id();
        $Chapter->project_id = $request->input('project_id');
        $Chapter->name = $request->input('item_name');

        $Chapter->save();

        return redirect('dashboard')->with('success', 'Раздел ' . $Chapter->name . ' добавлен.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id, Request $request)
    {

        //Запоминаю путь к странице, с которой ушел на форму добавления для использования в ридеректе сюда обратно
        //Сделал не через сессию, а через возврат на экшн контроллера
        //session(['UrlLinkForReturnBack' => request()->path()]);

        // get the chapter for the current User
        //Сначала проверяем User, а только потом запрос к таблице, не наоборот!

        $chapter = Chapter::where('user_id', Auth::id())->findOrFail($id);
        //$rule = Chapter::where('user_id', Auth::id())->findOrFail($id);
        //dd($rule);

        //Получаем для текущего пользователя все ссылки и правила из таблиц URLS и RULES
        $urls = Chapter::find($chapter->id)->urls->sortByDesc ('created_at');
        $rules = Chapter::find($chapter->id)->rules->sortByDesc ('created_at');
        $results = Qprogress::toBase()->where('chapter_id', $id)->get();
        //dd($results);

        //Записали id выбранной вкладки проекта
        session(['ProjectMenuTabIdKey' => $chapter->project_id]);
        session(['ChapterMenuTabIdKey' => $chapter->id]); //Записали id выбранной вкладки парсера

        $projectsMenuItems = $request->get('projectsMenuItems');
        $chaptersMenuItems = $request->get('chaptersMenuItems');

        Session::put ('ChapterIdForAppServiceProvider', $id);


        // show the view and pass the chapter to it
        return view('chapters.show')
            ->with('chapter', $chapter)
            ->with ('urls', $urls)
            ->with ('rules', $rules)
            ->with ('results', $results)
            ->with('projectsMenuItems', $projectsMenuItems)
            ->with('chaptersMenuItems', $chaptersMenuItems);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
