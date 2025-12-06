<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyectos - MYD Controles Industriales</title>
    <link rel="stylesheet" href="{{ asset('css/proyectos-user.css') }}">
    
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
</head>
<body>
    @include('components.navigation')

    <main class="main-content">

        <section class="projects-intro-section">
            <div class="intro-content">
                <div class="projects-intro-text">
                    <h1>Proyectos que Inspiran Confianza</h1>
                    <p>A lo largo de nuestra trayectoria, hemos colaborado en una amplia gama de proyectos, demostrando nuestro compromiso con la innovación y la excelencia.</p>
                    
                    <div class="counters">
                        <div class="counter-item">
                            <span id="counter1" data-target="100">0+</span>
                            <p>Proyectos Ejecutados</p>
                        </div>
                        <div class="counter-item">
                            <span id="counter2" data-target="50">0+</span>
                            <p>Clientes Satisfechos</p>
                        </div>
                    </div>
                </div>
                <div class="projects-intro-images">
                    <img src="{{ asset('img/proyectos/imagen1.jpg') }}" alt="Instalación eléctrica industrial de alta precisión">
                    <img src="{{ asset('img/proyectos/imagen8.jpg') }}" alt="Panel de control automatizado en funcionamiento">
                    <img src="{{ asset('img/proyectos/imagen9.jpg') }}" alt="Técnico supervisando sistema de control">
                </div>
            </div>

            <div class="client-logos-container" aria-label="Nuestros Clientes">
                
                <div class="logos-track">
                    <figure><img src="{{ asset('img/proyectos/logos/agro_berry.png') }}" alt="Logo de Google"></figure>
                    <figure><img src="{{ asset('img/proyectos/logos/acp.png') }}" alt="Logo de Mailchimp"></figure>
                    <figure><img src="{{ asset('img/proyectos/logos/avo.png') }}" alt="Logo de Dribbble"></figure>
                    <figure><img src="{{ asset('img/proyectos/logos/grundfos.png') }}" alt="Logo de Pinterest"></figure>
                    <figure><img src="{{ asset('img/proyectos/logos/grupoRocio.png') }}" alt="Logo de Product Hunt"></figure>
                    <figure><img src="{{ asset('img/proyectos/logos/ipesa.png') }}" alt="Logo de Google"></figure>
                    <figure><img src="{{ asset('img/proyectos/logos/jordie.png') }}" alt="Logo de Mailchimp"></figure>
                    <figure><img src="{{ asset('img/proyectos/logos/netafim.png') }}" alt="Logo de Dribbble"></figure>
                    <figure><img src="{{ asset('img/proyectos/logos/relix.png') }}" alt="Logo de Pinterest"></figure>
                    <figure><img src="{{ asset('img/proyectos/logos/tala.png') }}" alt="Logo de Product Hunt"></figure>
                </div>
            </div>
        </section>

        <section class="projects-gallery-section section--light">
    <div class="section-header">
        <h2 class="section-title">Proyectos Recientes</h2>
        <p class="section-subtitle">Un vistazo a nuestras soluciones más innovadoras y recientes entregadas a nuestros clientes.</p>
    </div>

    {{-- Verificamos si la colección de proyectos no está vacía --}}
    @if ($proyectos && !$proyectos->isEmpty())
        <div class="proyectos-grid">
            @foreach ($proyectos as $proyecto)
                {{-- La tarjeta entera es un enlace. Debería apuntar al detalle del proyecto. --}}
                <a href="#" class="proyecto-card">
                    <figure class="proyecto-card-image">
                        <img src="{{ Storage::url($proyecto->foto_empresa_cliente) }}" alt="Imagen del proyecto {{ $proyecto->titulo }}" />
                    </figure>
                    <div class="proyecto-card-content">
                        <div class="proyecto-meta">
                            <span class="meta-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                                {{-- Asumo que el campo se llama 'nombre_empresa_cliente' --}}
                                {{ $proyecto->nombre_empresa_cliente }}
                            </span>
                            <span class="meta-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                {{-- Asumo que el campo de fecha está configurado como Carbon en su modelo --}}
                                {{-- Si no lo está, necesitará Carbon::parse($proyecto->fecha_del_proyecto)->format('d M, Y') --}}
                                {{ $proyecto->created_at->format('d M, Y') }}
                            </span>
                        </div>
                        <h3>{{ $proyecto->titulo }}</h3>
                        <p>{{ Str::limit($proyecto->descripcion, 110) }}</p>
                        
                    </div>
                </a>
            @endforeach
        </div>       
        
         
    @else
        {{-- Mensaje que se muestra si no hay proyectos --}}
        <p class="no-projects-message">Actualmente no hay proyectos publicados. Vuelva pronto.</p>
    @endif
</section>

<section class="proyectos-realizados-section">
    <div class="section-header-inline">
        <h2>Proyectos Realizados</h2>
        
    </div>

    <div class="realizados-grid">

        <article class="realizado-card">
            <div class="card-image-container">
                <img src="{{ asset('img/proyectos/imagen11.jpg') }}" alt="Automatización de planta industrial" class="card-bg-image">
                
                <img src="{{ asset('img/logos/abroberry.png') }}" alt="Logo de Siemens" class="card-logo">

                <div class="card-hover-overlay">
                    <div class="overlay-content">
                        <span class="overlay-date">15 de Junio, 2025</span>
                        <p class="overlay-description">Implementación completa del sistema de control SCADA para la optimización de la línea de producción.</p>
                    </div>
                </div>
            </div>
            <div class="card-content">
                <span class="card-location">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                    Trujillo, Perú
                </span>
                <h3>Sistema de Control SCADA</h3>
                <p class="card-company">Siemens</p>
            </div>
        </article>

        <article class="realizado-card">
            <div class="card-image-container">
                <img src="{{ asset('img/proyectos/imagen4.jpg') }}" alt="Robótica industrial" class="card-bg-image">
                <img src="{{ asset('img/logos/grundfos.png') }}" alt="Logo de ABB" class="card-logo">
                <div class="card-hover-overlay">
                    <div class="overlay-content">
                        <span class="overlay-date">22 de Mayo, 2025</span>
                        <p class="overlay-description">Instalación y programación de brazo robótico para automatización de ensamblaje de componentes.</p>
                    </div>
                </div>
            </div>
            <div class="card-content">
                <span class="card-location">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                    Lima, Perú
                </span>
                <h3>Integración de Robótica</h3>
                <p class="card-company">ABB</p>
            </div>
        </article>

        <article class="realizado-card">
            <div class="card-image-container">
                <img src="{{ asset('img/proyectos/imagen5.jpg') }}" alt="Mantenimiento de planta" class="card-bg-image">
                <img src="{{ asset('img/logos/netafim.png') }}" alt="Logo de Rockwell Automation" class="card-logo">
                <div class="card-hover-overlay">
                    <div class="overlay-content">
                        <span class="overlay-date">10 de Abril, 2025</span>
                        <p class="overlay-description">Contrato de mantenimiento preventivo y correctivosdasdasdasdasdasdasdasdasdasdasdasdasdasdasd para la asdasdasdasdas a asdas dasdas dasd asd asd asdasd instrumentación de la planta de procesamiento.</p>
                    </div>
                </div>
            </div>
            <div class="card-content">
                <span class="card-location">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                    Chimbote, Perú
                </span>
                <h3>Mantenimiento de Instrumentación</h3>
                <p class="card-company">Rockwell Automation</p>
            </div>
        </article>
        
        </div>
</section>


    </main>
    
    <footer class="footer">
        <p>&copy; {{ date('Y') }} MYD Controles Industriales. Todos los derechos reservados.</p>
        <p>Contacto: <a href="mailto:info@mydcontrolesindustriales.com">david.terrones@mydcontrolesindustriales.com</a> | Teléfono: +51 997 865 066</p>
    </footer>


    <script src="{{ asset('js/proyectos-user.js') }}"></script>
</body>
</html>