<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;

class MatchController extends Controller
{
    public function index()
    {
        return view('app.pages.matches.index');
    }
}
