<?php

namespace App\Modules\Users\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Modules\Users\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthAdminController extends Controller
{
    public function showLogin()
    {
        if(Auth::check()) {
            return redirect()->route('dashboard.index');
        }

        return view('admin.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $user = User::query()
            ->where('email', '=', $request->get('email'))
            ->where('access', '!=', 'user')
            ->first();

        if (is_null($user)) {
            return redirect()->back()->withInput()->withErrors(['login-error' => 'Pro zadaný e-mail jsme nenašli žádného uživatele']);
        }

        if(!Hash::check($request->get('password'), $user->password)) {
            return redirect()->back()->withInput()->withErrors(['login-error' => 'Zadali jste nesprávné heslo']);
        }

        Auth::login($user);

        return redirect()->route('dashboard.index');
    }

    public function logut()
    {
        Auth::logout();
        return redirect()->route('show-login');
    }
}
