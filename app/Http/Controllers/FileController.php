<?php

namespace App\Http\Controllers;

use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index() {

        $filename = Storage::path('urls.txt');
        foreach(file($filename) as $line) {
            echo($line . '<br>');
        }
    }
}
