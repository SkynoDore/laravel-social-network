<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   // app/Http/Middleware/CheckRole.php
public function handle($request, Closure $next)
{
if (Auth::check() && Auth::user()->role === 'admin') {

        return $next($request);
    }
    abort(403, 'No tienes permiso para acceder.');
}
};
