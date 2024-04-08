<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Modules\Seasons\Models\Season;

class SeasonController extends Controller
{
    public function index(Season $season)
    {
        return view('app.pages.seasons.detail')->with(['season' => $season]);
    }
}
