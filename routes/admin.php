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

Route::middleware('admin')->group(function () {
    Route::controller(DashboardController::class)->middleware('admin')->group(function () {
        Route::get('/', 'index')->name('dashboard.index');
        Route::get('/uzivatele', 'users')->name('dashboard.users');
        Route::get('/zeme', 'countries')->name('dashboard.countries');
        Route::get('/ligy', 'leagues')->name('dashboard.leagues');
        Route::get('zapasy', 'games')->name('dashboard.games');
        Route::get('/hraci', 'players')->name('dashboard.players');
        Route::get('/rozhodci', 'referees')->name('dashboard.referees');
        Route::get('/sezony', 'seasons')->name('dashboard.seasons');
        Route::get('/sporty', 'sports')->name('dashboard.sports');
        Route::get('/stadiony', 'stadiums')->name('dashboard.stadiums');
        Route::get('/tymy', 'teams')->name('dashboard.teams');
    });
    Route::view("/uzivatel", "admin.users.new");
    Route::view("/uzivatel/{id}", "admin.users.update");
    Route::view("/tym", "admin.teams.new");
    Route::view("/tym/{id}", "admin.teams.update");
    Route::view("/stadion", "admin.stadiums.new");
    Route::view("/stadion/{id}", "admin.stadiums.update");
    Route::view("/sport/{id}", "admin.sports.update");
    Route::view("/vytvoritSport", "admin.sports.new");
    Route::view("/sezona", "admin.seasons.new");
    Route::view("/sezona/{id}", "admin.seasons.update");
    Route::view("/vytvoritRozhodci", "admin.referees.new");
    Route::view("/upravitRozhodci/{id}", "admin.referees.update");
    Route::view("/upravitHrace/{id}", "admin.players.update");
    Route::view("/vytvoritHrace", "admin.players.new");
    Route::view("/vytvoritZeme", "admin.countries.new");
    Route::view("/upravitZeme/{id}", "admin.countries.update");
    Route::view("/liga", "admin.leagues.new");
    Route::view("/liga/{id}", "admin.leagues.update");
    Route::view("/vytvoritZapas", "admin.games.new");
    Route::view("/upravitZapas/{id}", "admin.games.update");
});


Route::controller(AuthAdminController::class)->group(function () {
    Route::get('/prihlasit', 'showLogin')->name('show-login');
    Route::post('/login', 'login')->middleware('guest')->name('login');
    Route::get('logout', 'logut')->middleware('admin')->name('logout');
});
