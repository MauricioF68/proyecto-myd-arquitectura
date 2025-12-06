<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        // --- MODIFICACIÓN AQUÍ ---
        // Cambiamos el límite de 3 a 4 para el carrusel de la página de inicio.
        $proyectos = Proyecto::with('fotos')->orderBy('created_at', 'desc')->limit(4)->get();

        // La lógica del pop-up se mantiene intacta.
        $showWelcomePopup = Session::has('showWelcomePopup');

        // Retornar la vista 'home', pasando los proyectos y el estado del pop-up
        return view('home', compact('proyectos', 'showWelcomePopup'));
    }
}