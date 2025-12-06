<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recuperar Contraseña - {{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{ asset('css/forgot-password.css') }}">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

    <nav class="auth-top-nav">
        <a href="{{ url('/') }}" class="nav-link">
            <i class="fas fa-arrow-left"></i>
            <span>Ir a Inicio</span>
        </a>
        <a href="{{ route('login') }}" class="nav-link">
            <span>Iniciar Sesión</span>
            <i class="fas fa-sign-in-alt"></i>
        </a>
    </nav>

    <div class="auth-wrapper">
        <div class="auth-card">
            <div class="auth-header">
                <h2>¿Olvidaste tu Contraseña?</h2>
                <p>No hay problema. Ingresa tu correo y te enviaremos un enlace para que puedas elegir una nueva.</p>
            </div>
    
            <div class="form-message">
                <x-auth-session-status :status="session('status')" />
            </div>

            <form method="POST" action="{{ route('password.email') }}" class="auth-form">
                @csrf
    
                <div>
                    <label for="email">Correo Electrónico</label>
                    <div class="input-group">
                        <i class="fas fa-envelope"></i>
                        <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus placeholder="tu@email.com" />
                    </div>
                    <div class="form-message mt-2">
                        <x-input-error :messages="$errors->get('email')" />
                    </div>
                </div>
    
                <button type="submit" class="submit-button">
                    <i class="fas fa-paper-plane"></i>
                    <span>Enviar Enlace de Recuperación</span>
                </button>
            </form>
        </div>
    </div>
    
</body>
</html>