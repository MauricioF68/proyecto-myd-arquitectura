<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MYD Controles Industriales - Soluciones de Calidad</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>

<body>
    {{-- La navegación ahora tiene la estructura para el menú móvil --}}
    @include('components.navigation')

    <main>
        <header class="hero">
            <div class="hero-content">
                <div class="hero-text fade-in-scroll">
                    <h1>Agente de Servicio Técnico Autorizado GRUNDFOS</h1>
                    <p>Especialistas en mantenimiento de bombas hidráulicas, tableros industriales y conexiones eléctricas, ofreciendo soluciones duraderas y eficientes.</p>
                    <div class="hero-actions">
                        <a href="{{ url('/contacto') }}" class="btn btn-primary">Contáctanos Hoy</a>
                    </div>
                </div>
                <div class="hero-image fade-in-scroll">
                    <img src="{{ asset('img/quienes-somos/imagen6.png') }}" alt="Ilustración de servicios de MYD Controles Industriales">
                </div>
            </div>
        </header>


        <div class="logos-section" >
            <div class="logos-content">
                <h2 class="section-title fade-in-scroll" style="color: #333;">Nuestros Clientes</h2>

                <div class="logos-carousel-container fade-in-scroll">
                    <div class="logos-carousel-track">
                        <div class="logo-slide">
                            <a href="https://inscripcion.agroberries.pe/" target="_blank">
                                <img src="{{ asset('img/logos/abroberry.png') }}" alt="Agroberry">
                            </a>
                        </div>
                        <div class="logo-slide">
                            <a href="https://www.agrosoft.pe/clientes/" target="_blank">
                                <img src="{{ asset('img/logos/avo.png') }}" alt="Avo">
                            </a>
                        </div>
                        <div class="logo-slide">
                            <a href="https://www.grundfos.com/co/about-us/grundfos-in-peru" target="_blank">
                                <img src="{{ asset('img/logos/grundfos.png') }}" alt="Grundfos">
                            </a>
                        </div>
                        <div class="logo-slide">
                            <a href="https://www.netafim.pe/" target="_blank">
                                <img src="{{ asset('img/logos/netafim.png') }}" alt="Netafim">
                            </a>
                        </div>
                        <div class="logo-slide">
                            <a href="https://ipesahydro.com.pe/" target="_blank">
                                <img src="{{ asset('img/logos/ipesa.png') }}" alt="Ipesa">
                            </a>
                        </div>
                        <div class="logo-slide">
                            <a href="https://web.talsa.com.pe/" target="_blank">
                                <img src="{{ asset('img/logos/talsa.png') }}" alt="Talsa">
                            </a>
                        </div>
                        <div class="logo-slide">
                            <a href="https://relix.pe/" target="_blank">
                                <img src="{{ asset('img/logos/relix.png') }}" alt="Relix">
                            </a>
                        </div>
                        <div class="logo-slide">
                            <a href="https://66905661af175.site123.me/" target="_blank">
                                <img src="{{ asset('img/logos/jordie.png') }}" alt="Jordie">
                            </a>
                        </div>
                        <div class="logo-slide">
                            <a href="https://rocio.com.pe/" target="_blank">
                                <img src="{{ asset('img/logos/grupo_rosio.png') }}" alt="Grupo Rosio">
                            </a>
                        </div>
                        <div class="logo-slide">
                            <a href="https://www.acpagro.com/aboutus" target="_blank">
                                <img src="{{ asset('img/logos/acp.png') }}" alt="ACP">
                            </a>
                        </div>
                    </div>



                    <!-- Contadores -->
                    <div class="counters-container fade-in-scroll">
                        <div class="counters">
                            <div class="counter-item">
                                <span id="counter1" data-target="98">0</span>
                                <p>Proyectos trabajados</p>
                            </div>
                            <div class="counter-item">
                                <span id="counter2" data-target="25">0</span>
                                <p>Empresas trabajando juntos</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <section id="proyectos" class="projects-section">
            <div class="container">
                <h2 class="section-title fade-in-scroll">Nuestros Proyectos Recientes</h2>
                @if ($proyectos->isEmpty())
                <p class="empty-state">No hay proyectos publicados aún.</p>
                @else
                <div class="project-carousel-container fade-in-scroll">
                    <div class="project-carousel-track">
                        @foreach ($proyectos as $proyecto)
                        <div class="project-slide">
                            <a href="#" class="project-card">
                                <div class="project-image" style="background-image: url('{{ Storage::url($proyecto->foto_empresa_cliente) }}')"></div>
                                <div class="project-info-overlay">
                                    <h3>{{ $proyecto->titulo }}</h3>
                                    <p>Cliente: {{ $proyecto->nombre_empresa_cliente }}</p>
                                    <span class="project-date">Fecha: {{ $proyecto->created_at->format('d/m/Y') }}</span>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    <button id="prevBtn" class="carousel-btn prev" aria-label="Proyecto anterior">&#10094;</button>
                    <button id="nextBtn" class="carousel-btn next" aria-label="Siguiente proyecto">&#10095;</button>
                </div>
                @endif
            </div>
        </section>

        <section id="servicios" class="services-section">
            <div class="container">
                <h2 class="section-title fade-in-scroll">Nuestros Servicios</h2>
                <div class="services-list">
                    <article class="service-item fade-in-scroll">
                        <h3>Mantenimiento de Bombas</h3>
                        <p>Mantenimiento preventivo y correctivo para todo tipo de bombas hidráulicas, garantizando su óptimo funcionamiento y durabilidad.</p>
                        <a href="{{ url('/servicios') }}" class="btn-ver-mas">Ver más servicios</a>
                    </article>
                    <article class="service-item fade-in-scroll">
                        <h3>Fabricacion de Tableros Industriales</h3>
                        <p>Nuestros servicios abarca el diseño, fabricación e instalación de tableros de control industrial a medida, optimizando los procesos de tu planta.</p>
                        <a href="{{ url('/servicios') }}" class="btn-ver-mas">Ver más servicios</a>
                    </article>
                    <article class="service-item fade-in-scroll">
                        <h3>Proyectos de Conexiones Eléctricas</h3>
                        <p>Instalaciones y reparaciones eléctricas industriales seguras y eficientes, cumpliendo con los más altos estándares de calidad.</p>
                        <a href="{{ url('/servicios') }}" class="btn-ver-mas">Ver más servicios</a>
                    </article>

                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <p>&copy; {{ date('Y') }} MYD Controles Industriales. Todos los derechos reservados.</p>
        <p>Contacto: <a href="mailto:info@mydcontrolesindustriales.com">david.terrones@mydcontrolesindustriales.com</a> | Teléfono: +51 997 865 066</p>
    </footer>

    @if ($showWelcomePopup)
    <div class="modal-overlay" id="welcomeModal" role="dialog" aria-modal="true" aria-labelledby="modal-title">
        <div class="modal-content">
            <button class="modal-close" aria-label="Cerrar ventana modal">&times;</button>
            <h2 id="modal-title">¡Bienvenido a MYD Controles!</h2>
            <p>Como nuevo miembro de nuestra comunidad, te ofrecemos un descuento especial en tu primera cotización por cualquier servicio.</p>
            <div class="modal-buttons">
                <a href="{{ url('/contacto') }}" class="btn-contactar">Contáctate con nosotros</a>
                <a href="https://wa.me/51997865066" class="btn-whatsapp">Escríbenos a nuestro WhatsApp</a>
            </div>
        </div>
    </div>
    @endif

    <script src="{{ asset('js/home.js') }}"></script>
</body>

</html>