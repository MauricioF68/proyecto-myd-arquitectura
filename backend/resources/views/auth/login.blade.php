<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - {{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

    <a href="{{ url('/') }}" class="back-to-home">
        <i class="fas fa-arrow-left"></i>
        <span>Ir a la página de inicio</span>
    </a>

    <div class="login-wrapper">
        <div class="login-card">
            <div class="login-header">
                <div class="login-logo-container">
                    {{-- Coloque aquí la URL de su logo --}}
                    <img src="{{ asset('img/logos/logo.login.png') }}" alt="Logo de la Empresa">
                </div>
                <h2>¡Bienvenido de vuelta!</h2>
            </div>
    
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="login-form">
                @csrf
    
                <div>
                    <label for="email">Correo</label>
                    <div class="input-group">
                        <i class="fas fa-envelope"></i>
                        {{-- Usamos el componente de Breeze pero será estilizado por nuestro CSS --}}
                        <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus placeholder="tu@email.com" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
    
                <div>
                    <label for="password">Contraseña</label>
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <x-text-input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••••" />
                        <button type="button" id="password-toggle" aria-label="Mostrar u ocultar contraseña">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="form-links">
                    <span>¿No tienes cuenta? <a href="{{ route('register') }}" class="register-link">Regístrate</a></span>
                    
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">
                            {{ __('Olvidé mi contraseña') }}
                        </a>
                    @endif
                </div>
    
                <button type="submit" class="submit-button mt-6">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Ingresar</span>
                </button>
            </form>
        </div>
    </div>
    
    <script src="{{ asset('js/login.js') }}"></script>
</body>
</html>