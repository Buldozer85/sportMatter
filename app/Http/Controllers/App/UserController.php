<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        if(is_null(Auth::user())) {
            return redirect()->route('hockey.index');
        }

        return view('app.pages.user.profile');
    }
}
