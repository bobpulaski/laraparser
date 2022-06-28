<?php

namespace App\Jobs;

use App\Models\Result;
use App\Models\Rule;
use App\Models\Url;
use App\Models\Qprogress;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
    protected $projectId;

    public function __construct($id, $authUserId, $projectId)
    {
        $this->id = $id;
        $this->authUserId = $authUserId;
        $this->projectId = $projectId;
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
        //Qprogress::where('chapter_id', $this->id)->delete();




        //Запускаем код очереди

        $urls = Url::where('chapter_id', $this->id)->pluck('url');
        $rules = Rule::where('chapter_id', $this->id)->get();

        foreach ($urls as $url) {
            //sleep(rand(1, 2));

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
                    'url' => $url,
                ];

            }


        }

        Result::where('chapter_id', $rule->chapter_id)->delete();
        Result::insert($data);



        //Если успех, то обновляем статус на ('Выполнено') в таблице Прогресса
        /*Qprogress::where('queue_id', $this->job->getJobId())
            ->update(['qstatus' => 'Выполнено']);*/


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



}
