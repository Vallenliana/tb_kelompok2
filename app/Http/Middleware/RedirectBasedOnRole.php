<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectBasedOnRole
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->usertype === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif (Auth::user()->usertype === 'jamaah') {
                return redirect()->route('jamaah.dashboard');
            }
        }

        return $next($request);
    }
}
