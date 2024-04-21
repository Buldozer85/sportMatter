<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AboveEditorMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if(!user()->access->isAboveEditor()) {
            abort(403);
        }
        return $next($request);
    }
}
