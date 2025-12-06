<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verificar Correo - {{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{ asset('css/verify-email.css') }}">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

    <div class="auth-wrapper">
        <div class="auth-card">

            <div class="auth-header-icon">
                <i class="fas fa-paper-plane"></i>
            </div>

            <h2>Verifica tu Correo Electrónico</h2>

            <p>
                ¡Gracias por registrarte! Antes de comenzar, ¿podrías verificar tu dirección de correo electrónico haciendo clic en el enlace que te acabamos de enviar?
            </p>
            <p>Si no recibiste el correo, con gusto te enviaremos otro.</p>
    
            @if (session('status') == 'verification-link-sent')
                <div class="status-message">
                    {{ __('Se ha enviado un nuevo enlace de verificación a la dirección de correo electrónico que proporcionaste durante el registro.') }}
                </div>
            @endif

            <div class="action-buttons">
                <form method="POST" action="{{ route('verification.send') }}" style="width: 100%;">
                    @csrf
                    <button type="submit" class="resend-button">
                        {{ __('Reenviar Correo de Verificación') }}
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-button">
                        {{ __('Cerrar Sesión') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>