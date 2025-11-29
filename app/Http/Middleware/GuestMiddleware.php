<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to access this page.');
        }

        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard')->with('error', 'Admins cannot access guest pages.');
        }

        return $next($request);
    }
}