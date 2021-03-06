<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers;

class UrlController extends Controller
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {

        $projectsMenuItems = $request->get('projectsMenuItems');
        $chaptersMenuItems = $request->get('chaptersMenuItems');
        return view('urls.create')
            ->with('projectsMenuItems', $projectsMenuItems)
            ->with('chaptersMenuItems', $chaptersMenuItems);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //dd($request->all());

        $Url = new Url();

        $Url->user_id = Auth::id();
        $Url->project_id = $request->input('project_id');
        $Url->chapter_id = $request->input('chapter_id');
        $Url->url = $request->input('item_name');

        $Url->save();

        /*$chapter = Chapter::where('user_id', Auth::id())->findOrFail($id);
        $urls = Chapter::findOrFail($chapter->id)->urls;*/

        $projectsMenuItems = $request->get('projectsMenuItems');
        $chaptersMenuItems = $request->get('chaptersMenuItems');

        /*return \redirect ()->to (\Session::get('UrlLinkForReturnBack'))
            ->with('message', 'URL добавлен.');*/
        return redirect()->action([ChapterController::class, 'show'], [$request->get('chapter_id')])
            ->with('message', 'URL добавлен.');


    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Url $url
     * @return \Illuminate\Http\Response
     */
    public function show(Url $url)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Url $url
     * @return \Illuminate\Http\Response
     */
    public function edit(Url $url)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Url $url
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Url $url)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Url $url
     * @return \Illuminate\Http\Response
     */
    public function destroy(Url $url)
    {
        /*TODO проверить принадлежность проекту и пользователя*/
        //Получаем id пользователя текущей записи
        $userId = Url::where('id', $url->id)->value('user_id');

        //Если он не равен id текущего пользователя, удалять не разрешаем
        if ($userId === Auth::id()) {
            Url::destroy($url->id);
            return Redirect::back()->withErrors(['msg' => 'Удален URL: ' . $url->url]);
        } else {
            return Redirect::back()->withErrors(['msg' => 'Ошибка при удалении!']);
        }

    }
}
