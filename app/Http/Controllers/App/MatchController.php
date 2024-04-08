<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Modules\Games\Models\Game;

class MatchController extends Controller
{
    public function detail(Game $game)
    {
        $homeActions = $game->getMeta(\App\enums\FootballParameters::ACTIONS_HOME->value);

        $awayActions = $game->getMeta(\App\enums\FootballParameters::ACTIONS_AWAY->value);
        return view('app.pages.matches.index')->with(['match' => $game, 'homeActions' => $homeActions, 'awayActions' => $awayActions]);
    }

}
