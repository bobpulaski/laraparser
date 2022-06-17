<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Rule;
use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        //dd($id);

        $urls = Url::where('chapter_id', $id)->pluck('url');
        $rules = Rule::where('chapter_id', $id)->get();
        $i = -1;
        $j = -1;
        //$data = new Result;

        foreach ($urls as $url) {
            $i++;
            $content = file_get_contents($url);

            foreach ($rules as $rule) {
                $j++;
                $parsed = $this->get_string_between($content, $rule->rule_left, $rule->rule_right);
                //$data = array_fill(0, $i++, ['ext_header_name'=>$rule->header_name, 'ext_result'=>$parsed]);

                $data[$j] = [
                    'user_id' => Auth::id(),
                    'chapter_id' => $rule->chapter_id,
                    'project_id' => $rule->project_id,
                    'ext_header_name' => $rule->header_name,
                    'ext_result' => $parsed,
                ];

                /*$result->user_id = Auth::id();
                $result->chapter_id = $rule->chapter_id;
                $result->project_id = $rule->project_id;
                $result->ext_header_name = $rule->header_name;
                $result->ext_result = $parsed;
                $result->save();*/

            }

        }

        Result::where('chapter_id', $rule->chapter_id)->delete();
        $result = Result::insert($data);

        $grouped = Result::where('chapter_id', '12')
            ->groupBy('ext_header_name')
            ->get();

        //dd($data);
        dd($grouped);
    }


}
