<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios - MYD Controles Industriales</title>
    <link rel="stylesheet" href="{{ asset('css/servicios.css') }}">
    {{-- Esta línea carga los íconos que usaremos, como el check-circle --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    @include('components.navigation')

    <main>
        <section class="hero-section">
            <div class="container">
                <div class="hero-content">
                    <div class="hero-image-container">
                        <img src="{{ asset('img/proyectos/imagen1.jpg') }}" alt="Equipo de trabajo de MYD Controles Industriales en una planta industrial">
                    </div>
                    <div class="hero-text-container">
                        <div class="small-text">Nuestra Experiencia</div>
                        <h1>Servicios Industriales  Desde 2018</h1>
                        <p>
                            En MYD Controles Industriales, nos enorgullece nuestra trayectoria. 
                            Hemos desarrollado soluciones integrales para una variedad de clientes deltro del sector industrial, agroindustrial y minera 
                            optimizando sus procesos con tecnología de punta y un compromiso inquebrantable con la calidad.
                        </p>
                        {{-- Lista de beneficios con íconos de Font Awesome --}}
                        <ul class="benefit-list">
                            <li><i class="fas fa-check-circle"></i> Seguridad y Garantia</li>
                            <li><i class="fas fa-check-circle"></i> Calidad Garantizada</li>
                            <li><i class="fas fa-check-circle"></i> Servicio Personalizado</li>
                            <li><i class="fas fa-check-circle"></i> Equipo Tecnico Especializado</li>
                        </ul>
                        <a href="{{ url('/contacto') }}" class="btn-primary">Cotizar Proyecto</a>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="services-grid-section">
            <div class="container">
                <h2>Nuestros Principales Servicios</h2>
                <p class="section-description">Ofrecemos soluciones integrales y especializadas para cada una de las necesidades de su planta industrial.</p>

                <div class="services-grid">
                    
                    {{-- Tarjetas de servicio usando la etiqueta <article> para mejor semántica --}}
                    <article class="service-card" data-service="bombas">
                        <div class="icon-container">
                            <i class="fas fa-water"></i> 
                        </div>
                        <h3>Mantenimiento de Bombas</h3>
                        <p>Reparación y mantenimiento preventivo y correctivo para bombas de agua y sistemas de bombeo.</p>
                        
                    </article>

                    <article class="service-card" data-service="tableros">
                        <div class="icon-container">
                            <i class="fas fa-bolt"></i> 
                        </div>
                        <h3>Tableros Eléctricos</h3>
                        <p>Diseño, fabricación y montaje de tableros de control y distribución industrial.</p>
                        
                    </article>

                    <article class="service-card" data-service="conexiones">
                        <div class="icon-container">
                            <i class="fas fa-plug"></i> 
                        </div>
                        <h3>Conexiones Eléctricas</h3>
                        <p>Instalaciones y reparaciones eléctricas industriales, cableado estructurado y puesta a tierra.</p>
                        
                    </article>
                    
                    <article class="service-card" data-service="proyectos">
                        <div class="icon-container">
                            <i class="fas fa-industry"></i>
                        </div>
                        <h3>Proyectos de Automatización</h3>
                        <p>Desarrollo de soluciones de automatización industrial para optimizar tus procesos.</p>
                        
                    </article>

                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <p>&copy; {{ date('Y') }} MYD Controles Industriales. Todos los derechos reservados.</p>
        <p>Contacto: <a href="mailto:info@mydcontrolesindustriales.com">david.terrones@mydcontrolesindustriales.com</a> | Teléfono: +51 997 865 066</p>
    </footer>

    
    {{-- Manteniendo el script JS enlazado. Asumimos que maneja las animaciones de entrada. --}}
    <script src="{{ asset('js/servicios.js') }}"></script>
</body>
</html>