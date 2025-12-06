<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - MYD Admin</title>

    {{-- Enlace a Font Awesome para los iconos --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    {{-- CSS Principal del Admin (contiene la sidebar y el top-nav) --}}
    <link rel="stylesheet" href="{{ asset('css/admin/admin.css') }}">

    {{-- TUS ARCHIVOS CSS ESPECÍFICOS (¡ESTA ES LA PARTE QUE FALTABA!) --}}
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/proyectos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/solicitudes.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/clientes.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/create.css') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @stack('styles')
</head>
<body>
    <div class="admin-container"> 

        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <img src="{{ asset('img/logos/logo_dashboard.png') }}" alt="Logo">
                <span>M Y D</span>
            </div>

            <nav class="nav-menu">
                <a href="{{ route('admin.dashboard') }}" class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i><span>Dashboard</span>
                </a>
                <a href="{{ url('/admin/proyectos') }}" class="{{ Request::is('admin/proyectos*') ? 'active' : '' }}">
                    <i class="fas fa-project-diagram"></i><span>Proyectos</span>
                </a>
                <a href="{{ route('admin.solicitudes.index') }}" class="{{ Request::is('admin/solicitudes*') ? 'active' : '' }}">
                    <i class="fas fa-clipboard-list"></i><span>Solicitudes</span>
                </a>
                <a href="{{ route('admin.clientes.index') }}" class="{{ Request::is('admin/clientes*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i><span>Clientes</span>
                </a>
            </nav>
        </aside>

        <div class="overlay" id="overlay"></div>

        <div class="main-content-wrapper">
            <header class="top-nav">
                <div class="left-section">
                    <button class="menu-toggle" id="menu-toggle" aria-label="Abrir menú">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="logo-section">
                        <img src="{{ asset('img/logos/logo_dashboard.png') }}" alt="Logo">
                        <span>M Y D Controles Industriales</span>
                    </div>
                </div>
                
                <div class="user-profile" id="userProfileMenu">
                    <img src="{{ asset('img/logos/logo_dashboard.png') }}" alt="Avatar">
                    <span class="user-name">{{ Auth::user()->name }}</span>
                    <div class="dropdown-menu" id="dropdownMenu">
                        <a href="#">Mi Perfil</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">Cerrar sesión</button>
                        </form>
                    </div>
                </div>
            </header>

            <main>
                @yield('content')
            </main>
        </div>
        </div>

    {{-- (Aquí tus enlaces JS) --}}
    <script src="{{ asset('js/admin/admin.js') }}"></script>
    <script src="{{ asset('js/admin/solicitudes.js') }}"></script>
    <script src="{{ asset('js/admin/clientes.js') }}"></script>
    <script src="{{ asset('js/admin/create.js') }}"></script>
    <script src="{{ asset('js/admin/dashboard.js') }}"></script>
    <script src="{{ asset('js/admin/editar.js') }}"></script>
    <script src="{{ asset('js/admin/proyectos.js') }}"></script>    
    @stack('scripts')
    @yield('modal')

</body>
</html>