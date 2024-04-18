<?php

namespace App\Modules\Users\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Modules\Users\Models\User;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function update(UpdateUserProfileRequest $request)
    {
        user()->first_name = $request->get('first_name');
        user()->last_name = $request->get('last_name');
        user()->email = $request->get('email');

        if(!is_null($request->get('password'))) {
            user()->password = Hash::make($request->get('password'));
        }

        user()->save();

        return redirect()->route('user.profile');
    }

    public function index()
    {
        if(is_null(Auth::user())) {
            return redirect()->route('hockey.index');
        }

        return view('app.pages.user.profile');
    }
}
