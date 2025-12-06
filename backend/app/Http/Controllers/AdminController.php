<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\FormularioContacto;
use App\Models\User; // Usamos el modelo User para el conteo de clientes
use App\Models\PageView;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        
        // 1. Obtener las métricas principales
        $totalProyectos = Proyecto::count();
        $totalSolicitudes = FormularioContacto::count();
        $totalClientes = User::where('is_admin', false)->count(); // LÍNEA MODIFICADA
        $totalVisitas = PageView::count();
        $visitasHoy = PageView::whereDate('created_at', Carbon::today())->count();

        // 2. Obtener métricas detalladas de visitas
        $visitasPorMes = PageView::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        $visitasPorSemana = PageView::selectRaw('YEARWEEK(created_at) as week, COUNT(*) as total')
            ->groupBy('week')
            ->orderBy('week', 'desc')
            ->limit(4)
            ->get();

        // 3. Obtener la actividad reciente
        $solicitudesRecientes = FormularioContacto::orderBy('created_at', 'desc')->limit(5)->get();

        // 4. Preparar todos los datos para la vista
        $data = [
            'totalProyectos' => $totalProyectos,
            'totalSolicitudes' => $totalSolicitudes,
            'totalClientes' => $totalClientes,
            'totalVisitas' => $totalVisitas,
            'visitasHoy' => $visitasHoy,
            'visitasPorMes' => $visitasPorMes,
            'visitasPorSemana' => $visitasPorSemana,
            'solicitudesRecientes' => $solicitudesRecientes,
        ];

        // Retornar la vista del dashboard, pasando todas las métricas
        return view('admin.dashboard', $data);
    }
}