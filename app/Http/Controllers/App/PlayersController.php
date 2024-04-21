<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Modules\Players\Models\Player;
use App\Modules\Teams\Models\Team;
use Illuminate\Support\Facades\DB;

class PlayersController extends Controller
{
    public function index(Player $player)
    {
        $result = DB::select("SELECT * FROM players_latest_transfers WHERE id = ?", [$player->id]);

        return view('app.pages.players.index')->with(['player' => $player, 'transfers' => $result]);
    }
}
