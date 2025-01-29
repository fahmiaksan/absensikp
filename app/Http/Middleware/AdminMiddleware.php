<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * 
     */
    public function handle(Request $request, Closure $next)  
    {  
        // Cek apakah pengguna adalah admin  
        if (Auth::check() && Auth::user()->role === 'admin') {  
            return $next($request);  
        }  
  
        // Jika bukan admin, redirect ke halaman lain (misalnya, halaman utama)  
        return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');  
    }  
}
