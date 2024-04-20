<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Modules\Teams\Models\Team;

class TeamsController extends Controller
{
    public function index(Team $team)
    {
        $latestHomeMatch = $team->homeMatches->first();
        $latestAwayMatch = $team->awayMatches->first();

        return view('app.pages.teams.detail')->with(['team' => $team, 'latestHomeMatch' => $latestHomeMatch, 'latestAwayMatch' => $latestAwayMatch]);
    }
}
