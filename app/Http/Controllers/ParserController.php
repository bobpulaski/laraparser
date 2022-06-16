<?php

namespace App\Http\Controllers;

use App\Models\Rule;
use App\Models\Url;
use Illuminate\Http\Request;

class ParserController extends Controller
{
    public function get_string_between($string, $start, $end) {
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }
    
    
    
    
    public function play ($id) {
        //dd($id);

        $urls = Url::where('chapter_id', $id)->pluck('url');
        $rules = Rule::where('chapter_id', $id)->get();

        foreach ($urls as $url)
        {
            $content = file_get_contents ($url);
            foreach ($rules as $rule)
            {
                $fullstring = $content;
                print_r($url . '<br>');
                $parsed = $this->get_string_between($fullstring, $rule->rule_left, $rule->rule_right);
                print_r($parsed . '<br>');
            }

            //print_r($url . '<br>');

        }


    }

    
}
