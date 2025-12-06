<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - MYD Controles Industriales</title>
    <link rel="stylesheet" href="{{ asset('css/contacto.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    @include('components.navigation')

    <main>
        <section class="contact-page-section">
            <div class="contact-wrapper">
                <div class="contact-info">
                    <h2>Información de Contacto</h2>
                    <p>Estamos aquí para ayudarte. Si tienes alguna pregunta sobre nuestros servicios, proyectos o si necesitas una cotización, no dudes en contactarnos.</p>
                    
                    {{-- Usamos <address> para información de contacto, es más semántico --}}
                    <address class="info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>Jr. Los Jardines, 375 Las Malvinas, Guadalupe, La Libertad, Perú</p>
                    </address>
                    <address class="info-item">
                        <i class="fas fa-envelope"></i>
                        <p><a href="mailto:info@mydcontroles.com">david.terrones@mydcontrolesindustriales.com</a></p>
                    </address>
                    <address class="info-item">
                        <i class="fas fa-phone-alt"></i>
                        <p><a href="tel:+51997865066">+51 997 865 066</a></p>
                    </address>

                    <div class="map-container">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.041534346077!2d-79.47327092557549!3d-7.236102671066659!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x904d3771fa966493%3A0x476017f0d06fec2e!2sM%20y%20D%20Controles%20Industriales!5e0!3m2!1sen!2spe!4v1756591467212!5m2!1sen!2spe" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>

                <div class="contact-form">
                    <h1>Déjanos un Mensaje</h1>
                    
                    {{-- El mensaje de éxito ahora usa una clase en lugar de estilos en línea --}}
                    @if (session('success'))
                        <div class="form-success-message">
                            {{ session('success') }}
                        </div>
                    @endif

                    <p>Por favor, llena el formulario para solicitar un servicio, cotización o sugerir un repuesto.</p>

                    <form action="{{ url('/contacto') }}" method="POST">
                        @csrf
                        <div class="form-group radio-group">
                            <label>Eres:</label>
                            <div class="radio-options">
                                <input type="radio" id="soy_persona" name="tipo_solicitante" value="persona" checked>
                                <label for="soy_persona">Una Persona</label>
                                <input type="radio" id="soy_empresa" name="tipo_solicitante" value="empresa">
                                <label for="soy_empresa">Una Empresa</label>
                            </div>
                        </div>
                        
                        <div id="campos_empresa" style="display: none;">
                            <div class="form-group">
                                <label for="ruc">Número de RUC:</label>
                                <input type="text" name="ruc" id="ruc" placeholder="Ej: 20123456789">
                            </div>
                            <div class="form-group">
                                <label for="razon_social">Razón Social:</label>
                                <input type="text" name="razon_social" id="razon_social" placeholder="Ej: ACME S.A.C.">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nombre_completo">Nombre Completo:</label>
                            <input type="text" name="nombre_completo" id="nombre_completo" required placeholder="Ej: Juan Pérez">
                        </div>
                        <div class="form-group">
                            <label for="numero_celular">Número de Celular (WhatsApp):</label>
                            <input type="tel" name="numero_celular" id="numero_celular" required placeholder="Ej: 987654321">
                        </div>
                        <div class="form-group">
                            <label for="correo_electronico">Correo Electrónico:</label>
                            <input type="email" name="correo_electronico" id="correo_electronico" required placeholder="Ej: juan.perez@email.com">
                        </div>
                        <div class="form-group">
                            <label for="mensaje">Mensaje:</label>
                            <textarea name="mensaje" id="mensaje" required rows="5" placeholder="Escribe aquí tu consulta..."></textarea>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn-submit">Enviar Solicitud</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>

     <footer class="footer">
        <p>&copy; {{ date('Y') }} MYD Controles Industriales. Todos los derechos reservados.</p>
        <p>Contacto: <a href="mailto:info@mydcontrolesindustriales.com">david.terrones@mydcontrolesindustriales.com</a> | Teléfono: +51 997 865 066</p>
    </footer>
    
    <script src="{{ asset('js/contacto.js') }}"></script>
</body>
</html>