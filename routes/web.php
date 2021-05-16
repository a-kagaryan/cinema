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

Route::get('/', [App\Http\Controllers\AppController::class, 'index']);
Route::get('/hall/{hall}', [App\Http\Controllers\AppController::class, 'hall'])->name('hall');
Route::get('/seance/{schedule}', [App\Http\Controllers\AppController::class, 'seance'])->name('seance');
Route::get('/order/{scheduleId}/{seatId}', [App\Http\Controllers\AppController::class, 'order'])->name('order');

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::resources([
        'halls' => \App\Http\Controllers\HallController::class,
        'films' => \App\Http\Controllers\FilmController::class,
        'schedules' => \App\Http\Controllers\ScheduleController::class,
    ]);
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
