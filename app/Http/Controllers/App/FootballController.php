<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;

class FootballController extends Controller
{
    public function index()
    {
        return view('app.pages.football.index');
    }
}
