<?php

namespace App\Jobs;

use App\Models\Result;
use App\Models\Rule;
use App\Models\Url;
use App\Models\Qprogress;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProcessResult implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $id;
    private $authUserId;

    public function __construct($id, $authUserId)
    {
        $this->id = $id;
        $this->authUserId = $authUserId;
    }

    /**
     * Execute the job.
     *
     * @param $id
     * @return void
     */
    public function handle()
    {

        //Удаляем все записи из очередей таблицы Прогресса для текущей главы
        XX__Qprogress::where('chapter_id', $this->id)->delete();

        //Добавляем запись со статусом ('В очереди') в таблицу Прогресса
        $qprogress = new Qprogress();
        $qprogress->chapter_id = $this->id;
        //Передать реальную переменную
        $qprogress->project_id = 11;
        $qprogress->user_id = $this->authUserId;
        $qprogress->queue_id = $this->job->getJobId();
        $qprogress->qstatus = 'В очереди';
        $qprogress->save();


        //Запускаем код очереди

        $urls = Url::where('chapter_id', $this->id)->pluck('url');
        $rules = Rule::where('chapter_id', $this->id)->get();

        foreach ($urls as $url) {
            sleep(rand(1, 2));

            $content = file_get_contents($url);

            foreach ($rules as $rule) {
                $parsed = $this->get_string_between($content, $rule->rule_left, $rule->rule_right);
                if (strlen($parsed) >= 100) {
                    $parsed = 'Результат превышает 100 символов.';
                }

                $data[] = [
                    'user_id' => $this->authUserId,
                    'chapter_id' => $rule->chapter_id,
                    'project_id' => $rule->project_id,
                    'ext_header_name' => $rule->header_name,
                    'ext_result' => $parsed,
                    'ext_url' => $url,
                ];

            }


        }

        Result::where('chapter_id', $rule->chapter_id)->delete();
        Result::insert($data);



        //Если успех, то обновляем статус на ('Выполнено') в таблице Прогресса
        Qprogress::where('queue_id', $this->job->getJobId())
            ->update(['qstatus' => 'Выполнено']);


    }

    public function get_string_between($string, $start, $end)
    {
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;

        return substr($string, $ini, $len);
    }

    public function failed()
    {
        // Called when the job is failing...
        Qprogress::where('queue_id', $this->job->getJobId())
            ->update(['qstatus' => 'Ошибка']);
    }

}
