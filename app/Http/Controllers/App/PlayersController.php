<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Modules\Players\Models\Player;
use App\Modules\Teams\Models\Team;

class PlayersController extends Controller
{
    public function index(Player $player)
    {
        return view('app.pages.players.index')->with(['player' => $player]);
    }
}
