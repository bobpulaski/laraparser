<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class FileController extends Controller
{
    public function index() {

        $url = new Url;
        $url->truncate();

        $filename = Storage::path('urls.txt');
        foreach(file($filename) as $line) {
            echo($line . '<br>');
            /*DB::table('urls')->insert([
                'url' => $line,
            ]);*/
            $url = new Url;
            $url->url = $line;
            $url->save();
        }

    }
}