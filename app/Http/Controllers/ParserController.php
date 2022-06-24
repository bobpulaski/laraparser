<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessResult;
use App\Models\Chapter;
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

    public function play($id, Request $request)
    {



        $authUserId = Auth::id();
        $projectId = Chapter::where('id', $id)->get('project_id');
        ProcessResult::dispatch($id, $authUserId);

        $response = array(
            'status' => 'success',
            'msg' => 'Задача добавлена в очередь.',
        );

        return response()->json($response);

        /*return view('results')
            ->with('ext_results_array', $all);*/


    }
}
