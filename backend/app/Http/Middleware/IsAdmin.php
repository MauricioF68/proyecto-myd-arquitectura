<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verificamos si el usuario está autenticado y si su campo 'is_admin' es verdadero.
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        // Si no es un administrador, lo redirigimos a la página de inicio.
        return redirect('/');
    }
}