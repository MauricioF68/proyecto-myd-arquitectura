@extends('layouts.admin')

@section('title', 'Proyectos')

@section('content')

    {{-- Cabecera de Página con Búsqueda Rápida y Botón de Filtros --}}
    <div class="page-header">
        <h1 class="page-title">Panel de Proyectos</h1>

        <div class="page-actions">
            {{-- Búsqueda rápida --}}
            <form action="{{ url('/admin/proyectos') }}" method="GET" class="filter-form">
                <div class="form-group">
                    <input type="text" name="search" id="quickSearch" placeholder="Buscar por título o cliente..." value="{{ request('search') }}">
                </div>
            </form>

            {{-- Botón para desplegar más filtros --}}
            <button id="toggleFiltersBtn" class="btn-toggle-filters">
                <i class="fas fa-filter"></i>
                <span>Más Filtros</span>
            </button>

            <a href="{{ url('/admin/proyectos/crear') }}" class="btn-create">
                <i class="fas fa-plus"></i>
                <span>Crear Nuevo</span>
            </a>
        </div>
    </div>

    {{-- Panel de Filtros Avanzados (oculto por defecto) --}}
    <div id="advancedFiltersPanel" class="advanced-filters-panel">
        <form action="{{ url('/admin/proyectos') }}" method="GET" class="filter-form">
            {{-- Incluimos el campo de búsqueda aquí también para que se envíe con el resto de filtros --}}
            <input type="hidden" name="search" value="{{ request('search') }}">

            <div class="form-group">
                <label for="year">Año:</label>
                <select name="year" id="year">
                    <option value="">Todos los Años</option>
                    @for ($i = date('Y'); $i >= 2000; $i--)
                        <option value="{{ $i }}" {{ request('year') == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div class="form-group">
                <label for="month">Mes:</label>
                <select name="month" id="month">
                    <option value="">Todos los Meses</option>
                    @foreach (range(1, 12) as $month)
                        <option value="{{ $month }}" {{ request('month') == $month ? 'selected' : '' }}>{{ \Carbon\Carbon::create()->month($month)->locale('es')->monthName }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="date">Fecha Específica:</label>
                <input type="date" name="date" id="date" value="{{ request('date') }}">
            </div>

            <div class="form-group">
                {{-- Espaciador para alinear los botones a la derecha --}}
                <div style="flex-grow: 1;"></div>
                <a href="{{ url('/admin/proyectos') }}" class="btn-clear-filters">Limpiar Filtros</a>
                <button type="submit" class="btn-search">Aplicar Filtros</button>
            </div>
        </form>
    </div>


    {{-- Mensaje de Éxito Estilizado --}}
    @if (session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    {{-- El resto del archivo (grid de proyectos) se mantiene igual --}}
    @if ($proyectos->isEmpty())
        <div class="content-section" style="text-align: center;">
            <p>No hay proyectos creados que coincidan con la búsqueda.</p>
        </div>
    @else
        <div class="projects-grid">
            @foreach ($proyectos as $proyecto)
                <div class="project-card fade-in-item">
                    @if ($proyecto->foto_empresa_cliente)
                        <img src="{{ Storage::url($proyecto->foto_empresa_cliente) }}" alt="Foto de la empresa" class="card-image">
                    @endif
                    <div class="card-content">
                        <h3>{{ $proyecto->titulo }}</h3>
                        <p class="card-client">{{ $proyecto->nombre_empresa_cliente }}</p>
                        <p class="card-description">{{ Str::limit($proyecto->descripcion, 80) }}</p>
                        <p class="card-meta">Creado: {{ $proyecto->created_at->format('d/m/Y') }}</p>
                    </div>
                    <div class="card-actions">
                        <a href="{{ route('proyectos.edit', $proyecto->id) }}" class="btn-edit">Editar</a>
                        <form action="{{ route('proyectos.destroy', $proyecto->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" onclick="return confirm('¿Estás seguro de que quieres eliminar este proyecto?');">Eliminar</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

@endsection