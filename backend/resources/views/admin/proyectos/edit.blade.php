@extends('layouts.admin')

@section('title', 'Editar Proyecto')

@section('content')

    <div class="page-header">
        <h1 class="page-title">Editar Proyecto: {{ $proyecto->titulo }}</h1>
        <a href="{{ url('/admin/proyectos') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i>
            <span>Volver al Panel</span>
        </a>
    </div>

    <form action="{{ route('proyectos.update', $proyecto->id) }}" method="POST" enctype="multipart/form-data" class="form-card">
        @csrf
        @method('PUT')
        <div class="form-grid">
            
            <div class="form-group">
                <label for="titulo">Título del Proyecto:</label>
                <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $proyecto->titulo) }}" required>
            </div>

            <div class="form-group">
                <label for="nombre_empresa_cliente">Nombre de la Empresa Cliente:</label>
                <input type="text" name="nombre_empresa_cliente" id="nombre_empresa_cliente" value="{{ old('nombre_empresa_cliente', $proyecto->nombre_empresa_cliente) }}" required>
            </div>
            
            <div class="form-group full-width">
                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" id="descripcion" required>{{ old('descripcion', $proyecto->descripcion) }}</textarea>
            </div>

            <div class="form-group">
                <label for="estadisticas">Estadísticas (opcional):</label>
                <input type="text" name="estadisticas" id="estadisticas" value="{{ old('estadisticas', $proyecto->estadisticas) }}">
            </div>

            <div class="form-group">
                <label for="tiempo_trabajado">Tiempo Trabajado (opcional):</label>
                <input type="text" name="tiempo_trabajado" id="tiempo_trabajado" value="{{ old('tiempo_trabajado', $proyecto->tiempo_trabajado) }}">
            </div>

            <div class="form-group">
                <label for="foto_empresa_cliente">Reemplazar Foto de portada del proyecto:</label>
                <div class="custom-file-input-wrapper">
                    <label for="foto_empresa_cliente" class="custom-file-input-label">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <span>Haz clic para seleccionar un archivo nuevo</span>
                    </label>
                    <input type="file" name="foto_empresa_cliente" id="foto_empresa_cliente">
                    <div class="file-name-display"></div>
                </div>

                @if($proyecto->foto_empresa_cliente)
                    <div class="file-preview">
                        <p>Imagen Actual:</p>
                        <img src="{{ Storage::url($proyecto->foto_empresa_cliente) }}" alt="Foto actual de la empresa">
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="fotos_proyecto">Añadir más Fotos del Proyecto (opcional):</label>
                <div class="custom-file-input-wrapper">
                    <label for="fotos_proyecto" class="custom-file-input-label">
                        <i class="fas fa-images"></i>
                        <span>Haz clic para seleccionar archivos</span>
                    </label>
                    <input type="file" name="fotos_proyecto[]" id="fotos_proyecto" multiple>
                    <div class="file-name-display"></div>
                </div>
                {{-- Aquí podrías añadir una galería de las fotos existentes si lo deseas --}}
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">Actualizar Proyecto</button>
            </div>
        </div>
    </form>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/editar.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/admin/editar.js') }}"></script>
@endpush