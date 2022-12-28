<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HttpsProtocol
{
    public function handle(Request $request, Closure $next)
    {
        if (! $request->secure() && app()->isProduction()) {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}
