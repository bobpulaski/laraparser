<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Rule;
use App\Models\Url;
use Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class ParserController extends Controller
{
    public function get_string_between($string, $start, $end)
    {
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;

        return substr($string, $ini, $len);
    }


    public function play($id)
    {

        $urls = Url::where('chapter_id', $id)->pluck('url');
        $rules = Rule::where('chapter_id', $id)->get();
        $j = -1;
        /*
                foreach ($urls as $url) {
                    $content = file_get_contents($url);

                    foreach ($rules as $rule) {
                        $j++;
                        $parsed = $this->get_string_between($content, $rule->rule_left, $rule->rule_right);
                        $data[$j] = [
                            'user_id' => Auth::id(),
                            'chapter_id' => $rule->chapter_id,
                            'project_id' => $rule->project_id,
                            'ext_header_name' => $rule->header_name,
                            'ext_result' => $parsed,
                        ];
                    }

                }

                Result::where('chapter_id', $rule->chapter_id)->delete();
                $result = Result::insert($data);
                */


        $count_strings = DB::table('results')
            ->select('ext_header_name', 'chapter_id')
            ->where('chapter_id', $id)
            ->groupBy('ext_header_name', 'chapter_id')
            ->count();

        $headers = DB::table('rules')
            ->where('chapter_id', $id)
            ->get('header_name');


        //Получаем все заголовки из таблицы Rules
        $headers = DB::table('rules')
            ->where('chapter_id', $id)
            ->get('header_name');


        //Получаем все результаты из таблицы Results
        $results = DB::table('results')
            ->where('chapter_id', $id)
            ->get();

        //Проходим по каждому заголовку и делаем выборку результатов для каждого заголовка
        $i = -1;
        foreach ($headers as $header) {
            $i++;
            //dd($header->header_name);
            //$ext_results_array[$i] = [$header->header_name => DB::table('results')->where('ext_header_name', $header->header_name)->find('ext_result')];
            //$ext_results_array[$i] = [$header->header_name => DB::table('results')->where('ext_header_name', $header->header_name)->get()];
        }


        //$arr = ($ext_results_array);
        //dd($results);
        //var_dump($ext_results_array);

        return view('results')
            ->with('ext_results_array', $results);


    }

}
