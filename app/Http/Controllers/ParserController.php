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
        $j = 0;


        foreach ($urls as $url) {
            sleep(rand(1, 5));
            $content = file_get_contents($url);


            foreach ($rules as $rule) {
                $parsed = $this->get_string_between($content, $rule->rule_left, $rule->rule_right);
                if (strlen($parsed) >= 100) {
                    $parsed = 'Результат больше 100 символов. Уточните условие парсинга для данного правила.';
                };

                $data[] = [
                    'user_id' => Auth::id(),
                    'chapter_id' => $rule->chapter_id,
                    'project_id' => $rule->project_id,
                    'ext_header_name' => $rule->header_name,
                    'ext_result' => $parsed,
                    'ext_url' => $url,
                ];

                //$incoming[$rule->header_name] = $parsed;
            }
            //$incoming_summary[] = $incoming;


        }


        Result::where('chapter_id', $rule->chapter_id)->delete();
        Result::insert($data);

        //Получаем имеющиеся заголовки из таблицы Результатов
        $headers = DB::table('results')->where('chapter_id', $id)->groupBy('ext_header_name')->get('ext_header_name');

        //Получаем все записи из таблицы результатов
        $all = DB::table('results')->where('chapter_id', $id)->get();

        //dd($all);

        return view('results')
            ->with('ext_results_array', $all);



     /*   //Считаем количество заголовков для использывания шага в цикле
        $headers_count = count($headers);

        //Все результаты парсинга записываем в одномерный массив
        foreach ($all as $element) {
            $incoming[$element->ext_header_name] = $element->ext_result;
            $summary[] = $incoming;
            $incoming = [];
        }

        //dd($summary);


        //Проходим весь масссив результатов, зная сколько иттераций понадобится
        //для опредления следующего набора. Это определяется количеством заголовков
        for ($i = 0; $i < count($summary); $i += $headers_count) {
            $results_group = [];

            for ($j = 0; $j < $headers_count; $j++) {
                $results_group[] = $summary[$j];
            }
            $jopa[] = $results_group;
        }*/

        //dd($jopa);

//dd($summary);

        /*foreach ($headers as $header) {
            $headers_array[] = $header->ext_header_name;
        }
        //dd($headers_array);

        foreach ($all as $element) {
            $elements_array[] = $element->ext_result;
        }

        foreach($headers_array as $id=>$Name)
        {
            echo $FileType[$id] .":". $Name;
        }

        //dd ($headers_array, $elements_array);

        $combined = array_combine ($headers_array, $elements_array);

        dd ($combined);*/

//$combined = array_combine ($headers_array, $elements_array);

//print_r ($headers_array);

//dd($headers_array, $elements_array, $combined);


//$all_counts = count ($all);

//dd ($all_counts);

        /*      $incoming = array_combine ($headers, $all);

                  foreach ($all as $element) {



                      //$incoming[$element->ext_header_name] = $element->ext_result;
                      //$incoming_summary[] = $incoming;
                      //$incoming = [];
              }*/


//dd ($incoming);
        /*foreach ($headers as $header) {
            $incoming[$header->ext_header_name] = $element->ext_result;
        }*/

//$incoming_summary[] = $incoming;


//dd ($incoming_summary);

        /*        return view ('results')
                    /*->with('headers', $headers)
                    ->with ('ext_results_array', $incoming);*/

        /*
        Result::insert($data);*/


        /*$count_strings = DB::table('results')
            ->select('ext_header_name', 'chapter_id')
            ->where('chapter_id', $id)
            ->groupBy('ext_header_name', 'chapter_id')
            ->count();*/

        /*$headers = DB::table('rules')
            ->where('chapter_id', $id)
            ->get('header_name');*/


//Получаем все заголовки из таблицы Rules
        /*$headers = DB::table('rules')
            ->where('chapter_id', $id)
            ->get('header_name');*/


//Получаем все заголовки из таблицы Results
        /*$headers = DB::table('results')
            ->select('ext_header_name')
            ->where('chapter_id', $id)
            ->groupBy('ext_header_name')
            ->get();*/

        /*$headers_count = count($headers);*/


//dd($headers_count);

        /*          for ($i = 1; $i <= $headers_count; $i++) {

                  }*/
        /* $ext_results_array = DB::table('results')->get();*/

        /*foreach ($headers as $header) {
            //$ext_results_array[] = DB::table('results')->where('ext_header_name', $header->ext_header_name)->get('ext_result');
            //print_r($header->ext_header_name . '</br>');
            $ext_results_array[] = [$header->ext_header_name => DB::table('results')->where('ext_header_name', $header->ext_header_name)->get('ext_result')];
        }*/

//dd($ext_results_array);
//dd($headers);

//Проходим по каждому заголовку и делаем выборку результатов для каждого заголовка
        /*$i = -1;
        foreach ($headers as $header) {
            $i++;*/
//dd($header->header_name);
//$ext_results_array[$i] = [$header->header_name => DB::table('results')->where('ext_header_name', $header->header_name)->find('ext_result')];
//$ext_results_array[$i] = [$header->header_name => DB::table('results')->where('ext_header_name', $header->header_name)->get()];

//$arr = ($ext_results_array);
//dd($results);
//var_dump($ext_results_array);



    }
}
