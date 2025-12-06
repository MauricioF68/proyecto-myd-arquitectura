<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiénes Somos - MYD Controles Industriales</title>
    <link rel="stylesheet" href="{{ asset('css/quienes-somos.css') }}">
</head>
<body>
    @include('components.navigation')

    <div class="quienes-somos-section">
        <div class="quienes-somos-content">
            <div class="carousel-container-wrapper">
                <div class="carousel-container" id="carousel1">
                    <img src="{{ asset('img/quienes-somos/imagen1.png') }}" alt="Imagen de la empresa 1">
                    <img src="{{ asset('img/quienes-somos/imagen2.png') }}" alt="Imagen de la empresa 2">
                    <img src="{{ asset('img/quienes-somos/imagen3.png') }}" alt="Imagen de la empresa 3">
                </div>
                <div class="carousel-container" id="carousel2">
                    <img src="{{ asset('img/quienes-somos/imagen4.png') }}" alt="Imagen de la empresa 4">
                    <img src="{{ asset('img/quienes-somos/imagen5.png') }}" alt="Imagen de la empresa 5">
                    <img src="{{ asset('img/quienes-somos/imagen6.png') }}" alt="Imagen de la empresa 6">
                </div>
            </div>
             <div class="right-content-wrapper">
                <div class="text-content">
                    <h1>Quiénes Somos</h1>
                    <p>En MYD Controles Industriales, somos un equipo de profesionales jovenes, conformado por personal altamente calificado y con experiencia en gestion de mantenimiento nos dedicados a ofrecer soluciones eficientes y duraderas en el sector industrial.</p>
                </div>
                
                <div class="mision-vision-section">
                    <div class="tarjeta-container">
                        <div class="tarjeta">
                            <h3>Nuestra Misión</h3>
                            <p>Optimizar los procesos de nuestros clientes a través de un servicio de calidad y la más alta tecnología.</p>
                        </div>
                        <div class="tarjeta">
                            <h3>Nuestra Visión</h3>
                            <p>Ser líderes en el mercado, reconocidos por nuestra excelencia y compromiso con la satisfacción del cliente.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
    
    <footer class="footer">
        <p>&copy; {{ date('Y') }} MYD Controles Industriales. Todos los derechos reservados.</p>
        <p>Contacto: <a href="mailto:info@mydcontrolesindustriales.com">david.terrones@mydcontrolesindustriales.com</a> | Teléfono: +51 997 865 066</p>
    </footer>


    

   

    <script src="{{ asset('js/quienes-somos.js') }}"></script>
</body>
</html>