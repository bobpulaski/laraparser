<?php

namespace App\Http\Controllers;

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

Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';


/*PROJECT*/
Route::prefix('project')->group(function () {
    Route::get('/create', [ProjectController::class, 'create'])
        ->name('project.create');

    Route::post('/store', [ProjectController::class, 'store'])
        ->name('project.store');

    Route::delete('{id}', [ProjectController::class, 'destroy'])
        ->name('project.destroy');

    Route::get('/edit/{id}', [ProjectController::class, 'edit'])
        ->name('project.edit');
});
