<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            return to_route('backend.dashboard');
        }

        return $next($request);
    }
}
