@extends('layouts.admin')

@section('title', 'Crear Nuevo Proyecto')

@section('content')

    <div class="page-header">
        <h1 class="page-title">Crear Nuevo Proyecto</h1>
        <a href="{{ url('/admin/proyectos') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i>
            <span>Volver al Panel</span>
        </a>
    </div>

    <form action="{{ url('/admin/proyectos') }}" method="POST" enctype="multipart/form-data" class="form-card">
        @csrf
        <div class="form-grid">
            
            <div class="form-group">
                <label for="titulo">Título del Proyecto:</label>
                <input type="text" name="titulo" id="titulo" required>
            </div>

            <div class="form-group">
                <label for="nombre_empresa_cliente">Nombre de la Empresa Cliente:</label>
                <input type="text" name="nombre_empresa_cliente" id="nombre_empresa_cliente" required>
            </div>
            
            <div class="form-group full-width">
                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" id="descripcion" required></textarea>
            </div>

            <div class="form-group">
                <label for="estadisticas">Estadísticas (opcional):</label>
                <input type="text" name="estadisticas" id="estadisticas">
            </div>

            <div class="form-group">
                <label for="tiempo_trabajado">Tiempo Trabajado (opcional):</label>
                <input type="text" name="tiempo_trabajado" id="tiempo_trabajado">
            </div>

            {{-- Campo de subida de archivo personalizado (individual) --}}
            <div class="form-group">
                <label for="foto_empresa_cliente">Foto de Portada del Proyecto</label>
                <div class="custom-file-input-wrapper"> 
                    <label for="foto_empresa_cliente" class="custom-file-input-label">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <span>Haz clic para seleccionar un archivo</span>
                    </label>
                    <input type="file" name="foto_empresa_cliente" id="foto_empresa_cliente">
                    <div class="file-name-display"></div>
                </div>
            </div>

            {{-- Campo de subida de archivo personalizado (múltiple) --}}
            <div class="form-group">
                <label for="fotos_proyecto">Fotos del Proyecto (puedes seleccionar varias):</label>
                <div class="custom-file-input-wrapper">
                    <label for="fotos_proyecto" class="custom-file-input-label">
                        <i class="fas fa-images"></i>
                        <span>Haz clic para seleccionar archivos</span>
                    </label>
                    <input type="file" name="fotos_proyecto[]" id="fotos_proyecto" multiple>
                    <div class="file-name-display"></div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">Guardar Proyecto</button>
            </div>
        </div>
    </form>
@endsection