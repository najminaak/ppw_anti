<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Admin
{
    public function handle(Request $request, Closure $next) {
        // cek apakah user merupakan admin
        if (Auth::check() && Auth::user()->level === 'admin') {
            return $next($request); 
        }

        // jika bukan admin maka ke halaman home
        return redirect('/home');
    }
}
