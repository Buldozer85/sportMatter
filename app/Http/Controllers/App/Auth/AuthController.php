<?php

namespace App\Http\Controllers\App\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Modules\Users\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('app.pages.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $user = User::query()
            ->where('email', '=', $request->get('email'))
            ->first();

        if (is_null($user)) {
            return redirect()->back()->withInput()->withErrors(['login-error' => 'Pro zadaný e-mail jsme nenašli žádného uživatele']);
        }

        if(!Hash::check($request->get('password'), $user->password)) {
            return redirect()->back()->withInput()->withErrors(['login-error' => 'Zadali jste nesprávné heslo']);
        }

        Auth::login($user);

        return redirect()->route('hockey.index');
    }

    public function showRegister()
    {
        return view('app.pages.auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $query = '
            CALL Register (?, ?, ?, ?, ?);
        ';

        DB::statement($query, [$request->get('first_name'), $request->get('last_name'), $request->get('email'), Hash::make($request->get('password')), 'user']);

        $user = User::query()->where('email', '=', $request->get('email'))->first();

        Auth::login($user);

        return redirect()->route('hockey.index');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('hockey.index');
    }
}
