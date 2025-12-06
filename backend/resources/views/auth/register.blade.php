<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro - {{ config('app.name', 'Laravel') }}</title>
    
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

    <nav class="auth-top-nav">
        <a href="{{ url('/') }}" class="nav-link">
            <i class="fas fa-arrow-left"></i>
            <span>Ir a Inicio</span>
        </a>
        <a href="{{ route('login') }}" class="nav-link">
            <span>Ya tengo cuenta</span>
            <i class="fas fa-sign-in-alt"></i>
        </a>
    </nav>
    <div class="auth-wrapper">
        <div class="auth-card">
            <div class="auth-header">
                <h2>Crea tu Cuenta</h2>
            </div>
    
            <form method="POST" action="{{ route('register') }}" class="auth-form">
                @csrf
    
                <div>
                    <label for="name">Nombre</label>
                    <div class="input-group">
                        <i class="fas fa-user"></i>
                        <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Tu nombre completo" />
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
    
                <div>
                    <label for="email">Correo</label>
                    <div class="input-group">
                        <i class="fas fa-envelope"></i>
                        <x-text-input id="email" type="email" name="email" :value="old('email')" required placeholder="tu@email.com" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
    
                <div>
                    <label for="password">Contraseña</label>
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <x-text-input id="password" type="password" name="password" required autocomplete="new-password" placeholder="••••••••••" />
                        <button type="button" id="password-toggle" class="password-toggle" aria-label="Mostrar u ocultar contraseña">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div>
                    <label for="password_confirmation">Confirmar Contraseña</label>
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••••" />
                        <button type="button" id="password-confirmation-toggle" class="password-toggle" aria-label="Mostrar u ocultar contraseña">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="form-links">
                    {{-- Este enlace ya no es necesario aquí, lo hemos movido arriba --}}
                </div>
    
                <button type="submit" class="submit-button mt-6">
                    <i class="fas fa-user-plus"></i>
                    <span>Registrarse</span>
                </button>
            </form>
        </div>
    </div>
    
    <script src="{{ asset('js/register.js') }}"></script>
</body>
</html>