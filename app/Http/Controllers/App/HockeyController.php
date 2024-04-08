<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Modules\Leagues\Models\League;
use App\Modules\Sports\Models\Sport;

class HockeyController extends Controller
{
    public function index()
    {
        $hockey = Sport::query()->where('name', '=', 'Hokej')->first();
        $hockeyLeagues = League::query()->where('sport_id', '=', $hockey->id)->get();
        return view('app.pages.hockey.index')->with(['hockeyLeagues' => $hockeyLeagues]);
    }
}
