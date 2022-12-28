<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ChangeLanguage
{
    public function handle(Request $request, Closure $next)
    {
        $request->is(['admin', 'admin/*']) ? app()->setLocale('az') : app()->setLocale('en');
        return $next($request);
    }
}
