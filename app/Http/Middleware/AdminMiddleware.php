<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // cek apakah user sudah login
        if (!Auth::check()) {
            return redirect('/register')->with('error', 'Silakan login dulu');
        }

        // cek apakah user admin
        if (!Auth::user()->isAdmin()) {
            // kalau bukan admin, redirect ke home + notifikasi
            return redirect('/')->with('error', 'Access denied. Kamu bukan admin');
        }

        return $next($request);
    }
}
