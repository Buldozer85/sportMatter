<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Modules\Users\Controllers\AuthAdminController;
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

Route::controller(DashboardController::class)->middleware('admin')->group(function () {
   Route::get('/', 'index')->name('dashboard.index');
});

Route::controller(AuthAdminController::class)->group(function () {
        Route::get('/prihlasit', 'showLogin')->name('show-login');
        Route::post('/login', 'login')->middleware('guest')->name('login');
        Route::get('logout', 'logut')->middleware('admin')->name('logout');
});
