<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->peran === 'admin') {
            return $next($request);
        }
        return redirect('/beranda')->with('error', 'Kamu bukan admin!');
    }
}

