<?php

namespace App\Jobs;

use App\Models\Result;
use App\Models\Rule;
use App\Models\Url;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class ProcessResult implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @param $id
     * @return void
     */
    public function handle()
    {
        $urls = Url::where('chapter_id', $this->id)->pluck('url');
        $rules = Rule::where('chapter_id', $this->id)->get();

        foreach ($urls as $url) {
            sleep(rand(1, 2));

            $content = file_get_contents($url);

            foreach ($rules as $rule) {
                $parsed = $this->get_string_between($content, $rule->rule_left, $rule->rule_right);
                if (strlen($parsed) >= 100) {
                    $parsed = 'Результат больше 100 символов. Уточните условие парсинга для данного правила.';
                }

                $data[] = [
                    'user_id' => Auth::id(),
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
