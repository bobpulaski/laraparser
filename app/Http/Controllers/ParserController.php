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
                    $content = file_get_contents($url);
                    $incoming = [];
                    foreach ($rules as $rule) {

                        $parsed = $this->get_string_between($content, $rule->rule_left, $rule->rule_right);
                        $incoming[] = [$rule->header_name => $parsed];

                        /*$data[] = [
                            'result' => $parsed,
                            /*'user_id' => Auth::id(),
                            'chapter_id' => $rule->chapter_id,
                            'project_id' => $rule->project_id,
                            'ext_header_name' => '',
                            'ext_result' => $rule->header_name .'##'. $parsed,*/
                        //];
                    }

                    $ext_results_array[] = ['jopa' => $incoming];
                }

                dd($ext_results_array);

        return view('results')
            /*->with('headers', $headers)*/
            ->with('ext_results_array', $ext_results_array);

                /*Result::where('chapter_id', $rule->chapter_id)->delete();
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

        /*return view('results')
            ->with('headers', $headers)
            ->with('ext_results_array', $ext_results_array);*/

    }
}
