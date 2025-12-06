@extends('layouts.admin')

@section('title', 'Solicitudes')

@section('content')
 

<div class="page-header">
    <h1 class="page-title">Solicitudes de Contacto</h1>
</div>

<div class="content-section">
    <table class="content-table">
        <thead>
            <tr>
                <th>Estado</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th class="message-col">Mensaje</th>
                <th>Fecha de Envío</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($solicitudes as $solicitud)
            <tr>
                <td>
                    @if ($solicitud->leido)
                    <span class="status-badge status-read">Leído</span>
                    @else
                    <span class="status-badge status-new">Nuevo</span>
                    @endif
                </td>
                <td>{{ Str::limit( $solicitud->nombre_completo,10) }}</td>
                <td>{{ Str::limit( $solicitud->correo_electronico,10) }}</td>
                <td class="message-col">{{ Str::limit($solicitud->mensaje, 20) }}</td>
                <td>{{ $solicitud->created_at->diffForHumans() }}</td>
                <td>
                    <div class="action-buttons">
                        {{-- Botón "Ver" con todos los datos necesarios para el modal --}}
                        <button class="action-btn view view-btn" title="Ver Detalle"
                            data-nombre="{{ $solicitud->nombre_completo }}"
                            data-correo="{{ $solicitud->correo_electronico }}"
                            data-celular="{{ $solicitud->numero_celular }}"
                            data-tipo="{{ ucfirst($solicitud->tipo_solicitante) }}"
                            data-mensaje="{{ $solicitud->mensaje }}">
                            <i class="fas fa-eye"></i>
                        </button>

                        {{-- Puedes añadir los otros botones aquí si lo deseas en el futuro --}}
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 2rem;">No hay solicitudes de contacto por el momento.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if ($solicitudes->hasPages())
<nav class="pagination-container" aria-label="Navegación de páginas">

    {{-- Texto "Mostrando X a Y..." --}}
    <p class="pagination-summary">
        Mostrando del <strong>{{ $solicitudes->firstItem() }}</strong> al <strong>{{ $solicitudes->lastItem() }}</strong> de <strong>{{ $solicitudes->total() }}</strong> resultados
    </p>

    {{-- Contenedor de los botones --}}
    <ul class="pagination">
        {{-- Botón "Anterior" --}}
        @if ($solicitudes->onFirstPage())
        <li class="page-item disabled" aria-disabled="true">
            <span class="page-link"><i class="fas fa-chevron-left"></i></span>
        </li>
        @else
        <li class="page-item">
            <a class="page-link" href="{{ $solicitudes->previousPageUrl() }}" rel="prev"><i class="fas fa-chevron-left"></i></a>
        </li>
        @endif

        {{-- Botón "Siguiente" --}}
        @if ($solicitudes->hasMorePages())
        <li class="page-item">
            <a class="page-link" href="{{ $solicitudes->nextPageUrl() }}" rel="next"><i class="fas fa-chevron-right"></i></a>
        </li>
        @else
        <li class="page-item disabled" aria-disabled="true">
            <span class="page-link"><i class="fas fa-chevron-right"></i></span>
        </li>
        @endif
    </ul>
</nav>
@endif

@endsection

@section('modal')
<div class="modal-overlay" id="solicitudModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Detalle de la Solicitud</h3>
            <button id="modalCloseBtn" class="modal-close-btn">&times;</button>
        </div>
        <div class="modal-body">
            <div class="info-grid">
                <div class="info-item">
                    <strong>Nombre Completo</strong>
                    <span id="modal-nombre"></span>
                </div>
                <div class="info-item">
                    <strong>Correo Electrónico</strong>
                    <a href="#" id="modal-correo"></a>
                </div>
                <div class="info-item">
                    <strong>Celular (WhatsApp)</strong>
                    <span id="modal-celular"></span>
                </div>
                <div class="info-item">
                    <strong>Tipo de Solicitante</strong>
                    <span id="modal-tipo"></span>
                </div>
            </div>
            <div class="info-item message-content">
                <strong>Mensaje Completo</strong>
                <p id="modal-mensaje"></p>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#" id="modal-whatsapp-link" class="btn-whatsapp" target="_blank">
                <i class="fab fa-whatsapp"></i>
                Contactar por WhatsApp
            </a>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script src="{{ asset('js/admin/solicitudes.js') }}"></script>
@endpush