<?php

use App\Http\Controllers\Admin\DashboardController;

use App\Modules\Countries\Controllers\CountriesController;
use App\Modules\Games\Controllers\GamesController;
use App\Modules\Leagues\Controllers\LeaguesController;
use App\Modules\Players\Controllers\PlayersController;
use App\Modules\Referees\Controllers\RefereesController;
use App\Modules\Seasons\Controllers\SeasonsController;
use App\Modules\Sports\Controllers\SportController;
use App\Modules\Stadiums\Controllers\StadiumsController;
use App\Modules\Teams\Controllers\TeamsController;
use App\Modules\Users\Controllers\AuthAdminController;
use App\Modules\Users\Controllers\UserAdminController;
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
        Route::middleware('above-editor')->group(function () {
            Route::get('/', 'index')->name('dashboard.index');
            Route::get('/uzivatele', 'users')->name('dashboard.users');
            Route::get('/zeme', 'countries')->name('dashboard.countries');
            Route::get('/ligy', 'leagues')->name('dashboard.leagues');
            Route::get('/hraci', 'players')->name('dashboard.players');
            Route::get('/rozhodci', 'referees')->name('dashboard.referees');
            Route::get('/sezony', 'seasons')->name('dashboard.seasons');
            Route::get('/sporty', 'sports')->name('dashboard.sports');
            Route::get('/stadiony', 'stadiums')->name('dashboard.stadiums');
            Route::get('/tymy', 'teams')->name('dashboard.teams');
        });

        Route::get('zapasy', 'games')->name('dashboard.games');
        Route::get('/profil', 'profile')->name('dashboard.profile');
    });

    Route::controller(UserAdminController::class)->prefix('/uzivatel')->group(function () {
        Route::middleware('superadmin')->group(function () {
            Route::get('/vytvorit', 'showCreate')->name('admin.users.show-new');
            Route::get('/{user}', 'showUpdate')->name('admin.users.show-update');
            Route::post('/create', 'create')->name('admin.users.create');
            Route::post('/update/{user}', 'update')->name('admin.users.update');
        });

        Route::post('profil/update', 'updateProfile')->name('admin.users.update-profile');
    });

    Route::middleware('above-editor')->group(function () {
        Route::controller(SportController::class)->prefix('/sport')->group(function () {
            Route::get('/vytvorit', 'showCreate')->name('admin.sports.show-create');
            Route::get('/{sport}', 'showUpdate')->name('admin.sports.show-update');
            Route::post('/create', 'create')->name('admin.sports.create');
            Route::post('/update/{sport}', 'update')->name('admin.sports.update');
        });

        Route::controller(RefereesController::class)->prefix('/rozhodci')->group(function () {
            Route::get('/vytvorit', 'showCreate')->name('admin.referees.show-create');
            Route::get('/{referee}', 'showUpdate')->name('admin.referees.show-update');
            Route::post('/create', 'create')->name('admin.referees.create');
            Route::post('/update/{referee}', 'update')->name('admin.referees.update');
        });

        Route::controller(CountriesController::class)->prefix('/zeme')->group(function () {
            Route::get('/vytvorit', 'showCreate')->name('admin.countries.show-create');
            Route::get('/{country}', 'showUpdate')->name('admin.countries.show-update');
            Route::post('/create', 'create')->name('admin.countries.create');
            Route::post('/update/{country}', 'update')->name('admin.countries.update');
        });

        Route::controller(TeamsController::class)->prefix('/tym')->group(function () {
            Route::get('/vytvorit', 'showCreate')->name('admin.teams.show-create');
            Route::get('/{team}', 'showUpdate')->name('admin.teams.show-update');
            Route::post('/create', 'create')->name('admin.teams.create');
            Route::post('/update/{team}', 'update')->name('admin.teams.update');
        });

        Route::controller(StadiumsController::class)->prefix('/stadion')->group(function () {
            Route::get('/vytvorit', 'showCreate')->name('admin.stadiums.show-create');
            Route::get('/{stadium}', 'showUpdate')->name('admin.stadiums.show-update');
            Route::post('/create', 'create')->name('admin.stadiums.create');
            Route::post('/update/{stadium}', 'update')->name('admin.stadiums.update');
        });

        Route::controller(LeaguesController::class)->prefix('/liga')->group(function () {
            Route::get('/vytvorit', 'showCreate')->name('admin.leagues.show-create');
            Route::get('/{league}', 'showUpdate')->name('admin.leagues.show-update');
            Route::post('/create', 'create')->name('admin.leagues.create');
            Route::post('/update/{league}', 'update')->name('admin.leagues.update');
        });

        Route::controller(PlayersController::class)->prefix('/hrac')->group(function () {
            Route::get('/vytvorit', 'showCreate')->name('admin.players.show-create');
            Route::get('/{player}', 'showUpdate')->name('admin.players.show-update');
            Route::post('/create', 'create')->name('admin.players.create');
            Route::post('/update/{player}', 'update')->name('admin.players.update');
        });

        Route::controller(SeasonsController::class)->prefix('/sezona')->group(function () {
            Route::get('/vytvorit', 'showCreate')->name('admin.seasons.show-create');
            Route::get('/{season}', 'showUpdate')->name('admin.seasons.show-update');
            Route::post('/create', 'create')->name('admin.seasons.create');
            Route::post('/update/{season}', 'update')->name('admin.seasons.update');
        });
    });

    Route::controller(GamesController::class)->prefix('/zapas')->group(function () {
        Route::get('/vytvorit', 'showCreate')->name('admin.games.show-create')->middleware('above-editor');
        Route::get('/{game}', 'showUpdate')->name('admin.games.show-update')->can('view', 'game');
        Route::post('/create', 'create')->name('admin.games.create')->middleware('above-editor');
        Route::post('/update/{game}', 'update')->name('admin.games.update')->can('update', 'game');
    });
});


Route::controller(AuthAdminController::class)->group(function () {
    Route::get('/prihlasit', 'showLogin')->name('admin.show-login');
    Route::post('/login', 'login')->middleware('guest')->name('admin.login');
    Route::get('logout', 'logut')->middleware('admin')->name('admin.logout');
});
