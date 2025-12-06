@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <h1 class="page-title">Resumen Ejecutivoo</h1>

    <div class="card-grid">
        <div class="stat-card">
            <div class="card-header">
                <h3>Proyectos</h3>
                <i class="fas fa-briefcase icon"></i>
            </div>
            <p class="stat-number">{{ $totalProyectos }}</p>
            <div class="navigation-links">
                <a href="{{ url('/admin/proyectos') }}">Ver Proyectos</a>
                <a href="{{ url('/admin/proyectos/crear') }}">Crear Nuevo</a>
            </div>
        </div>
        <div class="stat-card">
            <div class="card-header">
                <h3>Solicitudes de Contacto</h3>
                <i class="fas fa-bell icon"></i>
            </div>
            <p class="stat-number">{{ $totalSolicitudes }}</p>
            <div class="navigation-links">
                <a href="{{ route('admin.solicitudes.index') }}">Ver Solicitudes</a>
            </div>
        </div>
        <div class="stat-card">
            <div class="card-header">
                <h3>Clientes Registrados</h3>
                <i class="fas fa-users icon"></i>
            </div>
            <p class="stat-number">{{ $totalClientes }}</p>
            <div class="navigation-links">
                <a href="{{ route('admin.clientes.index') }}">Ver Clientes</a>
            </div>
        </div>
        <div class="stat-card">
            <div class="card-header">
                <h3>Visitas Hoy</h3>
                <i class="fas fa-eye icon"></i>
            </div>
            <p class="stat-number">{{ $visitasHoy }}</p>
            <div class="navigation-links">
                <a href="#">Ver Reportes</a>
            </div>
        </div>
    </div>

    <div class="content-section">
        <h2>Actividad Reciente - Últimas 5 Solicitudes</h2>
        <table class="content-table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Correo</th>
                    <th>Mensaje</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($solicitudesRecientes as $solicitud)
                <tr>
                    <td>{{ $solicitud->nombre_completo }}</td>
                    <td>{{ ucfirst($solicitud->tipo_solicitante) }}</td>
                    <td>{{ $solicitud->correo_electronico }}</td>
                    <td>{{ Str::limit($solicitud->mensaje, 20) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align: center;">No hay solicitudes recientes.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="card-grid">
        <div class="chart-container">
            <h2>Visitas por Mes</h2>
            <canvas id="visitasMesChart"></canvas>
            
            {{-- La tabla original ahora está oculta y solo sirve como fuente de datos para el JS --}}
            <table id="visitasMesTable" class="data-source-table">
                <tbody>
                    @foreach ($visitasPorMes as $visita)
                    <tr>
                        <td>{{ $visita->year }}-{{ str_pad($visita->month, 2, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $visita->total }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="chart-container">
            <h2>Visitas por Semana (Últimas 4)</h2>
            <canvas id="visitasSemanaChart"></canvas>

            {{-- La tabla original ahora está oculta y solo sirve como fuente de datos para el JS --}}
            <table id="visitasSemanaTable" class="data-source-table">
                <tbody>
                    @foreach ($visitasPorSemana as $visita)
                    <tr>
                        <td>Semana {{ $visita->week }}</td>
                        <td>{{ $visita->total }}</td>
                    </tr>
                    @endforeach
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script src="{{ asset('js/admin/dashboard.js') }}"></script>
                </tbody>
            </table>
        </div>
    </div>
@endsection