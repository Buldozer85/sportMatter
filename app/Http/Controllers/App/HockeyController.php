<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;

class HockeyController extends Controller
{
    public function index()
    {
        return view('app.pages.hockey.index');
    }
}
