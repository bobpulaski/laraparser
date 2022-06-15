<?php

namespace App\Http\Controllers;

use App\Models\Rule;
use App\Models\Url;
use Illuminate\Http\Request;

class ParserController extends Controller
{
    public function play ($id) {
        //dd($id);

        $urls = Url::where('chapter_id', $id)->pluck('url');
        $rules = Rule::where('chapter_id', $id)->pluck('header_name');

        foreach ($urls as $url)
        {
            print_r($url . '<br>');
        }


    }
}
