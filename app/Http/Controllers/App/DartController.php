<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;

class DartController extends Controller
{
    public function index()
    {
        return view('app.pages.dart.index');
    }
}
