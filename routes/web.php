<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', [ProjectController::class, 'index'])
    ->middleware(['auth'])
    ->middleware(['updateleftmenu'])
    ->name('dashboard');

require __DIR__ . '/auth.php';


/*PROJECT*/
Route::prefix('project')->group(function () {
    Route::get('/create', [ProjectController::class, 'create'])
        ->middleware(['auth'])
        ->middleware(['updateleftmenu'])
        ->name('project.create');

    Route::post('/store', [ProjectController::class, 'store'])
        ->middleware(['auth'])
        ->middleware(['updateleftmenu'])
        ->name('project.store');

    Route::delete('{id}', [ProjectController::class, 'destroy'])
        ->middleware(['auth'])
        ->middleware(['updateleftmenu'])
        ->name('project.destroy');

    Route::get('/edit/{id}', [ProjectController::class, 'edit'])
        ->middleware(['auth'])
        ->middleware(['updateleftmenu'])
        ->name('project.edit');

    Route::put('{id}', [ProjectController::class, 'update'])
        ->middleware(['auth'])
        ->middleware(['updateleftmenu'])
        ->name('project.update');
});



Route::group(['middleware' => ['auth', 'updateleftmenu', 'GetChapterIdMW']], function () {
    Route::resource('project/chapter', ChapterController::class);
});

Route::group(['middleware' => ['auth', 'updateleftmenu']], function () {
    // uses 'auth' middleware plus all middleware from $middlewareGroups['web']
    Route::resource('project/chapter/url', UrlController::class); //Make a CRUD controller
});

Route::group(['middleware' => ['auth', 'updateleftmenu']], function () {
    // uses 'auth' middleware plus all middleware from $middlewareGroups['web']
    Route::resource('project/chapter/rule', RuleController::class); //Make a CRUD controller
});


Route::get('ajax', function(){ return view('ajax'); });

Route::post('project/chapter/{id}/parser', [ParserController::class, 'play'])
    ->middleware(['auth'])
    ->middleware(['updateleftmenu'])
    ->name('parser.play');

Route::post('project/{project_id}/chapter/{chapter_id}/file/create', [FileController::class,'create'])
    ->middleware(['auth'])
    ->middleware(['updateleftmenu'])
    ->name('file.create');

Route::post('project/{project_id}/chapter/{chapter_id}/file/get', [FileController::class,'getFile'])
    ->middleware(['auth'])
    ->middleware(['updateleftmenu'])
    ->name('file.get');

//Route::post('/postajax', [AjaxController::class, 'post']);

/*Route::resource('project/chapter/url', UrlController::class)
    ->middleware(['auth'])
    ->middleware(['updateleftmenu']);*/
