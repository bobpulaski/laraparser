<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use Illuminate\Support\Facades\Route;

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
    ->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';


/*PROJECT*/
Route::prefix('project')->group(function () {
    Route::get('/create', [ProjectController::class, 'create'])
        ->middleware(['auth'])
        ->name('project.create');

    Route::post('/store', [ProjectController::class, 'store'])
        ->middleware(['auth'])
        ->name('project.store');

    Route::delete('{id}', [ProjectController::class, 'destroy'])
        ->middleware(['auth'])
        ->name('project.destroy');

    Route::get('/edit/{id}', [ProjectController::class, 'edit'])
        ->middleware(['auth'])
        ->name('project.edit');

    Route::put('/{id}', [ProjectController::class, 'update'])
        ->middleware(['auth'])
        ->name('project.update');
});


Route::prefix('chapter')->resource('chapter', ChapterController::class)->middleware(['auth']);

/*Route::prefix('chapter')->group(function () {
    Route::post('/store', [ChapterController::class, 'store'])
        ->middleware(['auth'])
        ->name('chapter.store');
});*/

Route::get('x', function () {
   $users = User::all ();

   foreach ($users as $user) {
        echo 'User name: ' . $user['name'] . '<br>';
        echo 'Users projects: ' . '</br>';
        foreach ($user->projects as $project) {
            echo $project['name'] . '</br>';
       }
        echo '_________________</br>';
    }
});
