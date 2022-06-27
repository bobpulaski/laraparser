<?php

namespace App\Http\Controllers;

use App\Http\Middleware\GetChapterIdMW;
use App\Jobs\ProcessResult;
use App\Models\Chapter;
use App\Models\Qprogress;
use App\Models\Result;
use App\Models\Rule;
use App\Models\Url;
use Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class ParserController extends Controller
{

    public function play($id, Request $request)
    {
        $authUserId = Auth::id();
        $projectId = Chapter::where('id', $id)->first();

       //Удаляем из таблицы Прогресса записи, относящиеся к этой Chapter этого пользователя
        Qprogress::where('chapter_id', $id)->delete();

        //Добавляем запись со статусом ('В очереди') в таблицу Прогресса
        $qprogress = new Qprogress();
        $qprogress->chapter_id = $id;
        $qprogress->project_id = $projectId->project_id;
        $qprogress->user_id = $authUserId;
        $qprogress->queue_id = 0;
        $qprogress->payload = '';
        $qprogress->qstatus = 'В очереди';
        $qprogress->save();

        ProcessResult::dispatch($id, $authUserId, $projectId);


        //Для Аякса
        /*$response = array(
            'status' => 'success',
            'msg' => 'Задача добавлена в очередь.',
        );

        return response()->json($response);*/

        /*return view('results');
            ->with('ext_results_array', $all);*/


        return redirect()->action([ChapterController::class, 'show'], [$id])
            ->with('message', 'Задача добавлена в очередь');


    }
}
