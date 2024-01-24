<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ScoreController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//RUTAS DEL SISTEMA DE LOGIN Y OAUTH

Route::get('/github-auth', function () {
    return Socialite::driver('github')->redirect();
});
Route::get('/github-auth/callback',[LoginController::class,'authCallbackGit']);


Route::get('/google-auth', function () {
    return Socialite::driver('google')->redirect();
});
Route::get('/google-auth/callback',[LoginController::class, 'handleGoogleCallback']);

Route::view('/', 'login')->name('login');
Route::view('/registro', 'register')->name('registro');
Route::view('/privada', 'secret')->middleware('auth')->name('privada');


Route::post("/validar-registro",[LoginController::class, 'register']) -> name('validar-registro');
Route::post("/inicia-sesion",[LoginController::class, 'login']) -> name('inicia-sesion');
Route::get("/logout",[LoginController::class, 'logout']) -> name('logout');

//VIEW DEL CALENDARIO
Route::view('/calendar', 'calendar')->name('calendar');

//RUTAS CRUD CALENDARIO
Route::get('/calendar', [EventController::class, 'showCalendar'])->middleware('auth')->name('calendar');
Route::post('/event/store', [EventController::class, 'store'])->name('event.store');
Route::put('/event/update/{id}', [EventController::class, 'update'])->name('event.update');
Route::delete('/event/destroy/{id}', [EventController::class, 'destroy'])->name('event.destroy');

//VIEW SQWORD
Route::view('/sqword','sqword')->name('sqword')->middleware('auth')->name('sqword');

Route::post('/score', [ScoreController::class, 'store'])->middleware('auth');
Route::get('/scores/last-five', [ScoreController::class, 'getLastFiveScores'])->middleware('auth');
