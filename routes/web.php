<?php

use App\Http\Controllers\App\Auth\AuthController;
use App\Http\Controllers\App\HockeyController;
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

Route::controller(AuthController::class)->group(function () {
    Route::get('/registrace', 'showRegister')->name('app.show-register');
    Route::post('/register', 'register')->name('app.register');
    Route::get('/prihlaseni', 'showLogin')->name('app.show-login');
    Route::post('/login', 'login')->name('app.login');
    Route::get('/odhlasit', 'logout')->name('app.logout');
});


Route::get('/', function () {
    return redirect()->route('hockey.index');
});
