<?php

namespace App\Http\Middleware;

use App\Models\PageView; // Importamos el modelo
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackPageViews
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Solo queremos contar las visitas a la página de inicio
        if ($request->is('/')) {
            PageView::create([
                'path' => $request->path(),
            ]);
        }

        return $next($request);
    }
}