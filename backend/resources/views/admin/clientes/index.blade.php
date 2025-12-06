@extends('layouts.admin')

@section('title', 'Clientes')

@section('content')

    <div class="page-header">
        <h1 class="page-title">Clientes Registrados</h1>
    </div>

    <div class="content-section">
        <table class="content-table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Fecha de Registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($clientes as $cliente)
                <tr>
                    <td>{{Str::limit( $cliente->name,20) }}</td>
                    <td>{{Str::limit($cliente->email,20) }}</td>
                    <td>{{ $cliente->created_at->diffForHumans() }}</td>
                    <td>
                        <div class="action-buttons">
                            {{-- Botón "Ver" con los datos del cliente para el modal --}}
                            <button class="action-btn view view-btn" title="Ver Detalle"
                            
                                data-name="{{ $cliente->name }}"
                                data-email="{{ $cliente->email }}"
                                data-created="{{ $cliente->created_at->format('d/m/Y a las H:i') }}"
                                data-verified="{{ $cliente->email_verified_at ? 'Sí' : 'No' }}">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align: center; padding: 2rem;">No hay clientes registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Renderizar los enlaces de la paginación --}}
@if ($clientes->hasPages())
    <nav class="pagination-container" aria-label="Navegación de páginas">

        {{-- Texto "Mostrando X a Y..." --}}
        <p class="pagination-summary">
            Mostrando del <strong>{{ $clientes->firstItem() }}</strong> al <strong>{{ $clientes->lastItem() }}</strong> de <strong>{{ $clientes->total() }}</strong> resultados
        </p>

        {{-- Contenedor de los botones --}}
        <ul class="pagination">
            {{-- Botón "Anterior" --}}
            @if ($clientes->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link"><i class="fas fa-chevron-left"></i></span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $clientes->previousPageUrl() }}" rel="prev"><i class="fas fa-chevron-left"></i></a>
                </li>
            @endif

            {{-- Botón "Siguiente" --}}
            @if ($clientes->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $clientes->nextPageUrl() }}" rel="next"><i class="fas fa-chevron-right"></i></a>
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
<div class="modal-overlay" id="clientModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Detalles del Cliente</h3>
            <button id="modalCloseBtn" class="modal-close-btn">&times;</button>
        </div>
        <div class="modal-body">
            <div class="info-grid">
                <div class="info-item">
                    <strong>Nombre Completo</strong>
                    <span id="modal-name"></span>
                </div>
                <div class="info-item">
                    <strong>Correo Electrónico</strong>
                    <a href="#" id="modal-email"></a>
                </div>
                <div class="info-item">
                    <strong>Estado del Correo</strong>
                    <span id="modal-status"></span>
                </div>
                <div class="info-item">
                    <strong>Miembro Desde</strong>
                    <span id="modal-registered"></span>
                </div>
            </div>
        </div>
    </div>  
</div>
@endsection   

@push('scripts')
    <script src="{{ asset('js/admin/clientes.js') }}"></script>
@endpush
