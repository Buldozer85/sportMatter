<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Modules\Games\Models\Game;
use App\Modules\Leagues\Models\League;
use App\Modules\Sports\Models\Sport;

class FootballController extends Controller
{
    public function index()
    {
        $football = Sport::query()->where('name', '=', 'Fotbal')->first();
        $footballLeagues = League::query()->where('sport_id', '=', $football->id)->get();
        return view('app.pages.football.index')->with(['footballLeagues' => $footballLeagues]);
    }

}
