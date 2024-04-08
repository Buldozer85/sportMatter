<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Modules\Leagues\Models\League;
use App\Modules\Sports\Models\Sport;

class DartController extends Controller
{
    public function index()
    {
        $darts = Sport::query()->where('name', '=', 'Šipky')->first();
        $dartsLeagues = League::query()->where('sport_id', '=', $darts->id)->get();
        return view('app.pages.dart.index')->with(['dartsLeagues' => $dartsLeagues]);
    }
}
