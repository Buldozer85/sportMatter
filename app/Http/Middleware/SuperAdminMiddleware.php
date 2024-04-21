<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SuperAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if(!user()->is_super_admin) {
            abort(403);
        }

        return $next($request);
    }
}
