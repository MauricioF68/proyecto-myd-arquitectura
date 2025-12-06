<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectosUserController extends Controller
{
    /**
     * Muestra la página de proyectos para el usuario final,
     * destacando los 3 más recientes.
     */
    public function index()
    {
        // --- MODIFICACIÓN PRINCIPAL AQUÍ ---
        // Cambiamos la consulta para obtener solo los 3 proyectos más recientes.
        // El método latest() es un atajo para orderBy('created_at', 'desc').
        $proyectosRecientes = Proyecto::with('fotos')->latest()->take(3)->get();

        // NOTA SOBRE '$proyectosAntiguos':
        // Esta variable con datos estáticos parece no ser necesaria para la nueva
        // sección de "Proyectos Recientes". Puede eliminarla si no la utiliza
        // en otra parte de la vista 'proyectos-user'. La mantendré por ahora
        // para no alterar otras posibles funcionalidades de su página.
        $proyectosAntiguos = [
            ['img' => asset('img/proyectos-antiguos/proyecto-antiguo-1.jpg')],
            ['img' => asset('img/proyectos-antiguos/proyecto-antiguo-2.jpg')],
            ['img' => asset('img/proyectos-antiguos/proyecto-antiguo-3.jpg')],
        ];

        // Pasamos la variable con los 3 proyectos recientes a la vista.
        // He renombrado la variable a '$proyectosRecientes' para mayor claridad,
        // pero la pasamos a la vista con la clave 'proyectos' para no romper
        // el bucle @foreach que ya tiene en su archivo Blade.
        return view('proyectos-user', [
            'proyectos' => $proyectosRecientes,
            'proyectosAntiguos' => $proyectosAntiguos
        ]);
    }
}