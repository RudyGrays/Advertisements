<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    
    public function handle(Request $request, Closure $next): Response
    {   
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Доступ запрещен');
        }
        return $next($request);
    }
}
