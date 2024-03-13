<?php

namespace App\Http\Middleware;

use App\enums\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdministrationMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if(is_null(Auth::user())) {
            abort(403);
        }

        if(Auth::user()->access->value !== Role::USER->value) {
            return $next($request);
        }

        abort(403);
    }
}
