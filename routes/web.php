<?php

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

Route::get ('/', function () {
    return view ('welcome');
});

/*Route::get ('/dashboard', function () {
    return view ('dashboard');
})->middleware (['auth'])->name ('dashboard');*/

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth'])->name ('dashboard');

require __DIR__ . '/auth.php';

/*Route::get ('/index', function () {
    return view ('index');
})->middleware (['auth'])->name ('dashboard');*/

Route::get ('/dashboard/new/project', [\App\Http\Controllers\FileController::class, 'addNewProject'])
    ->name ('addNewProjectForm');

Route::post ('store/new/project', [\App\Http\Controllers\AddNewProject::class, 'store'])
    ->name ('storeNewProject');
<<<<<<< HEAD

=======
>>>>>>> bceeb21318abc51944b289df9726f7d3603b85ad
