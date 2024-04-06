<?php

use App\Http\Controllers\App\DartController;
use App\Http\Controllers\App\FootballController;
use App\Http\Controllers\App\HockeyController;
use App\Http\Controllers\App\LeagueController;
use App\Http\Controllers\App\MatchController;
use App\Http\Controllers\App\SeasonController;
use App\Http\Controllers\App\UserController;
use App\Modules\Users\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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

Route::controller(HockeyController::class)->prefix('/hokej')->group(function () {
        Route::get('/', 'index')->name('hockey.index');
    });

Route::controller(FootballController::class)->prefix('/fotbal')->group(function () {
    Route::get('/', 'index')->name('football.index');
});

Route::controller(DartController::class)->prefix('/sipky')->group(function () {
    Route::get('/', 'index')->name('dart.index');
});

Route::controller(MatchController::class)->prefix('/')->group(function () {
    Route::get('/zapas/{game}', 'detail')->name('match.detail');
});

Route::controller(UserController::class)->prefix('/')->group(function () {
    Route::get('/profil', 'index')->name('user.profile');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/registrace', 'showRegister')->name('app.show-register');
    Route::post('/register', 'register')->name('app.register');
    Route::get('/prihlaseni', 'showLogin')->name('app.show-login');
    Route::post('/login', 'login')->name('app.login');
    Route::get('/odhlasit', 'logout')->name('app.logout');
});

Route::controller(LeagueController::class)->prefix('/liga')->group(function () {
    Route::get('/{league}', 'index')->name('league.index');
});

Route::controller(SeasonController::class)->prefix('/rocnik')->group(function () {
   Route::get('/{season}', 'index')->name('season.index');
});


Route::controller(\App\Modules\Users\Controllers\UserController::class)->prefix('/user')->group(function () {
    Route::get('/vytvorit', 'showCreate')->name('users.show-new');
    Route::get('/{user}', 'showUpdate')->name('users.show-update');
    Route::post('/create', 'create')->name('users.create');
    Route::post('/update/{user}', 'update')->name('users.update');
});


Route::get('/', function () {
    return redirect()->route('hockey.index');
});
