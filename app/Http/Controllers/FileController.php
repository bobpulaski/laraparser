<?php

namespace App\Http\Controllers;

use App\Models\Qprogress;
use App\Models\Url;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FileController extends Controller
{
    public function index()
    {

        $url = new Url;
        $url->truncate();

        $filename = Storage::path('urls.txt');
        foreach (file($filename) as $line) {
            echo($line . '<br>');
            /*DB::table('urls')->insert([
                'url' => $line,
            ]);*/
            $url = new Url;
            $url->url = $line;
            $url->save();
        }

    }

    public function create($project_id, $chapter_id)
    {

        //Удаляем текущий файл из хранилища перед формированием нового, если он существует
        $getCurrentFullFileName = Qprogress::toBase()
            ->where('chapter_id', $chapter_id)
            ->first('full_filename');
        $exists = Storage::disk('local')->exists($getCurrentFullFileName->full_filename);

        if ($exists) {
            Storage::delete($getCurrentFullFileName->full_filename);
        }

        $filename = Str::random(20) . '_' . $project_id . '_' . $chapter_id . '.csv';
        Storage::disk('local')->put($filename, 'Your content here');

        //!!! Переменные приходят умножеными на 19
        //!!! Перед использованием в запросах необходимо их вернуть путем деления на 19

        $getChapter = Qprogress::where('chapter_id', $chapter_id)
            ->first()
            ->update(array('full_filename' => $filename));
        /*        $getChapter->full_filename = $filename;
                $getChapter->save();*/

        dd(Storage::fileExists($filename));

        //!!! Переменные приходят умножеными на 19
        //!!! Перед использованием в запросах необходимо их вернуть путем деления на 19

    }

    public function getFile($project_id, $chapter_id)
    {

        $getCurrentFullFileName = Qprogress::toBase()
            ->where('chapter_id', $chapter_id)
            ->first('full_filename');

        $path = storage_path('app/' . $getCurrentFullFileName->full_filename);
        //dd($path);

        return response()->download($path);
    }

}
