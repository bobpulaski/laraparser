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

        //Формирование данных для записи в файл

        //Получение заголовков
        $headers = DB::table('results')->select('ext_header_name')
            ->where('chapter_id', $chapter_id)
            ->groupBy('ext_header_name')
            ->orderByDesc('ext_header_name')
            ->get();

        //Формирование строки с заголовками
        $csvHeaders = '';
        foreach ($headers as $header) {
            $csvHeaders .= $header->ext_header_name . ';';
        }
        $csvHeaders .= PHP_EOL;

        //Получение данных
        $datas = DB::table('results')->select('ext_result')
            ->where('chapter_id', $chapter_id)
            ->get();
        //dd($datas[1]);

        //Формирование строк с данными
        $csvData = '';
        $total = '';
        $step = 0;
        for ($i = 0; $i < count($datas); $i++) {

            if ($step != count($headers)) {
                $csvData .= $datas[$i]->ext_result . ';';
                //print_r(' $step = ' . $step . '</br>');
                //print_r($i . $csvData . '</br>');
                $step++;
            } else {
                print_r(' Вошли в else $step = ' . $step . '</br>');
                $csvData .= PHP_EOL;
                $csvData .= $datas[$i--]->ext_result . ';';
                print_r('ppp ' . $i);
                $csvData .= $datas[$i + $step]->ext_result . ';' . PHP_EOL;
                $total .= $csvData;
                print_r('total = ' . $total . '</br>');
                //print_r('total = ' . $total . '</br>');
                $csvData = '';
                $step = 0;
            }
        }

        dd($total);

        //////////////////////////////////////


        Storage::disk('local')->put($filename, $csvAllData);

        //!!! Переменные приходят умножеными на 19
        //!!! Перед использованием в запросах необходимо их вернуть путем деления на 19

        $getChapter = Qprogress::where('chapter_id', $chapter_id)
            ->first()
            ->update(array('full_filename' => $filename));
        /*        $getChapter->full_filename = $filename;
                $getChapter->save();*/

        //dd(Storage::fileExists($filename));

        //!!! Переменные приходят умножеными на 19
        //!!! Перед использованием в запросах необходимо их вернуть путем деления на 19

    }

    public function getFile($project_id, $chapter_id)
    {

        $getCurrentFullFileName = Qprogress::toBase()
            ->where('chapter_id', $chapter_id)
            ->first('full_filename');

        $path = storage_path('app/' . $getCurrentFullFileName->full_filename);

        return response()->download($path);
    }

}
