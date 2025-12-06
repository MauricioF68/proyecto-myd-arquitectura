<div class="header-nav">
    <div class="left-section">
        <a href="{{ url('/') }}" class="logo">M Y D</a>
    </div>

    <div class="menu-items" id="mobile-menu">
        <a href="{{ url('/') }}">Inicio</a>
        <a href="{{ route('quienes-somos.index') }}">Quienes Somos</a>
        <a href="{{ route('proyectos.user.index') }}">Proyectos</a>
        <a href="{{ route('servicios.index') }}">Servicios</a>
        <a href="{{ url('/contacto') }}">Contacto</a>
        
        <div class="mobile-auth-links">
            @auth
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
            @else
                <a href="{{ url('/login') }}">Iniciar Sesión</a>
                <a href="{{ url('/register') }}" class="register-btn">Registrarse</a>
            @endauth
            <a href="{{ url('/contacto') }}" class="cotizar-btn">Cotizar</a>
        </div>
    </div>

    <div class="right-section">
        @auth
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
        @else
            <a href="{{ url('/login') }}">Iniciar Sesión</a>
            <a href="{{ url('/register') }}" class="register-btn">Registrarse</a>
        @endauth
        <a href="{{ url('/contacto') }}" class="cotizar-btn">Cotizar</a>
    </div>

    <button class="hamburger-menu" id="hamburger-btn" aria-label="Abrir menú">
        <span></span>
        <span></span>
        <span></span>
    </button>
</div>

<style>
    .header-nav {
        background-color: rgba(10, 88, 167, 0.6);
        backdrop-filter: blur(10px);
        padding: 0.8rem 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        top: 0;
        z-index: 1000;
        box-sizing: border-box;
        /* --- CLAVE PARA MANTENER LA BARRA FIJA --- */
        position: fixed; 
    }

    .header-nav .left-section {
        display: flex;
        align-items: center;
    }

    .header-nav .logo {
        font-weight: 700;
        font-size: 1.8rem;
        color: #fff;
        text-decoration: none;
        text-transform: uppercase;
    }

    .header-nav .menu-items {
        display: flex;
        gap: 1.5rem;
        align-items: center;
        margin-left: 2rem;
    }

    .header-nav .menu-items a {
        text-decoration: none;
        color: #e2e8f0;
        padding: 0.5rem 1rem;
        transition: all 0.3s ease;
        position: relative;
    }

    .header-nav .menu-items a:hover {
        color: #fff;
    }

    .header-nav .menu-items a::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 0;
        height: 2px;
        background-color: #fff;
        transition: width 0.3s ease, left 0.3s ease;
    }

    .header-nav .menu-items a:hover::after {
        width: 100%;
        left: 0;
    }

    .header-nav .right-section {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .header-nav .right-section a {
        text-decoration: none;
        color: #fff;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        border: 1px solid rgba(255, 255, 255, 0.5);
        transition: background-color 0.3s ease, border-color 0.3s ease;
    }

    .header-nav .right-section a:hover {
        background-color: rgba(255, 255, 255, 0.2);
        border-color: #fff;
    }

    .cotizar-btn {
        background-color: #fca311;
        color: #1c3d5e !important;
        border: none !important;
        font-weight: 600;
        padding: 0.75rem 1.5rem !important;
        border-radius: 50px !important;
        transition: transform 0.3s ease, background-color 0.3s ease;
        cursor: pointer;
    }

    .cotizar-btn:hover {
        transform: translateY(-3px);
        background-color: #e6910a !important;
    }

    .mobile-auth-links {
        display: none;
    }

    .hamburger-menu {
        display: none;
        flex-direction: column;
        justify-content: space-around;
        width: 2rem;
        height: 2rem;
        background: transparent;
        border: none;
        cursor: pointer;
        padding: 0;
        z-index: 1010;
    }

    .hamburger-menu span {
        width: 2rem;
        height: 0.25rem;
        background: #fff;
        border-radius: 10px;
        transition: all 0.3s linear;
        position: relative;
        transform-origin: 1px;
    }

    .hamburger-menu.active span:nth-child(1) {
        transform: rotate(45deg);
    }
    .hamburger-menu.active span:nth-child(2) {
        opacity: 0;
        transform: translateX(20px);
    }
    .hamburger-menu.active span:nth-child(3) {
        transform: rotate(-45deg);
    }

    @media (max-width: 1024px) {
        .header-nav .menu-items {
            position: fixed;
            top: 0;
            right: -100%;
            width: 70%;
            max-width: 300px;
            height: 100vh;
            background-color: rgba(10, 88, 167, 0.95);
            backdrop-filter: blur(15px);
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 2rem;
            transition: right 0.4s ease-in-out;
            margin-left: 0;
        }

        .header-nav .menu-items.active {
            right: 0;
        }
        
        .header-nav .menu-items a {
            font-size: 1.2rem;
        }
        
        .header-nav .right-section {
            display: none;
        }

        .hamburger-menu {
            display: flex;
        }

        .mobile-auth-links {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.5rem;
            margin-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            padding-top: 2rem;
            width: 80%;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const hamburgerBtn = document.getElementById('hamburger-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        hamburgerBtn.addEventListener('click', function () {
            hamburgerBtn.classList.toggle('active');
            mobileMenu.classList.toggle('active');
        });

        const menuLinks = mobileMenu.querySelectorAll('a');
        menuLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (mobileMenu.classList.contains('active')) {
                    hamburgerBtn.classList.remove('active');
                    mobileMenu.classList.remove('active');
                }
            });
        });
    });
</script>