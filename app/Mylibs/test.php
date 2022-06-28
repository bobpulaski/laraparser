<?php


namespace App\Mylibs;


use App\Models\Chapter;
use App\Models\Qprogress;
use Illuminate\Support\Facades\Auth;

class test
{
    private $chapterId;

    public function __construct($chapterId)
    {
        $this->chapterId = $chapterId;
    }

    function Go () {
        //Получаем id текущего пользователя
        $authUserId = Auth::id();

        //Получаем id текущего проекта
        $projectId = Chapter::where('id', $this->chapterId)->first('project_id');

        //Удаляем из таблицы Прогресса записи, относящиеся к этой Chapter этого пользователя
        Qprogress::where('chapter_id', $this->chapterId)->delete();

        //Добавляем запись со статусом ('В очереди') в таблицу Прогресса
        $qprogress = new Qprogress();

        $qprogress->chapter_id = $this->chapterId;
        $qprogress->project_id = $projectId->project_id;
        $qprogress->user_id = $authUserId;
        $qprogress->queue_id = 0;
        $qprogress->payload = '';
        $qprogress->qstatus = 'В очереди11';

        $qprogress->save();

        return ['authUserId' => $authUserId, 'projectId' => $projectId, 'chapterId' => $this->chapterId];
    }
}
