<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Modules\Leagues\Models\League;

class LeagueController extends Controller
{
    public function index(League $league)
    {
        return view('app.pages.leagues.league')->with(['league' => $league]);
    }
}
