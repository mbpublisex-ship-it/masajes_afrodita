<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Masajes el templo de Afrodita')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Aquí cargamos todo (Bootstrap + nuestro SCSS) vía Vite --}}
    @vite(['resources/js/app.js', 'resources/scss/app.scss'])
    @if(request()->is('admin*'))
        @vite(['resources/js/app.js', 'resources/scss/admin.scss'])
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=Mulish:wght@300;400;500;600&display=swap"
    rel="stylesheet">

    <link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

</head>
<body>

{{-- CABECERA: ADMIN --}}
@if(auth()->check() && request()->is('admin*'))

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark admin-navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                Panel · Templo de Afrodita
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#adminNavbar" aria-controls="adminNavbar"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="adminNavbar">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        {{-- admin/masseuses, admin/masseuses/create, etc. --}}
                        <a class="nav-link {{ request()->is('admin/masseuses*') ? 'active' : '' }}"
                           href="{{ route('admin.masseuses.index') }}">
                            Masajistas
                        </a>
                    </li>

                    <li class="nav-item">
                        {{-- admin/services, admin/services/create, etc. --}}
                        <a class="nav-link {{ request()->is('admin/services*') ? 'active' : '' }}"
                           href="{{ route('admin.services.index') }}">
                            Servicios
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}" target="_blank">
                            Ver web
                        </a>
                    </li>

                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="nav-link btn btn-link admin-logout-link" type="submit">
                                Salir
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

@else
    {{-- 🌙 CABECERA PÚBLICA ESTILO TANTRA PALACE --}}
    @if(!request()->is('admin*') && !request()->routeIs('login') && !request()->routeIs('register'))
        <div class="age-gate-overlay is-hidden" role="dialog" aria-modal="true" aria-labelledby="age-gate-title">
            <div class="age-gate-overlay__backdrop"></div>
            <div class="age-gate-overlay__content">
                <h2 id="age-gate-title" class="age-gate-overlay__title">
                    Contenido solo para mayores de 18 años
                </h2>
                <p class="age-gate-overlay__text">
                    Este sitio está dirigido a público adulto y muestra imágenes sugerentes.
                    No ofrecemos servicios sexuales, únicamente masajes de bienestar y experiencias sensoriales.
                    Si eres mayor de 18 años, puedes continuar.
                </p>
                <div class="age-gate-overlay__actions">
                    <button type="button" class="btn age-gate-overlay__btn age-gate-overlay__btn--accept">
                        Sí, soy mayor de 18 años
                    </button>
                    <button type="button" class="btn age-gate-overlay__btn age-gate-overlay__btn--exit">
                        Salir
                    </button>
                </div>
            </div>
        </div>
    @endif

    <header class="site-header">

        {{-- 🔝 Franja superior con dirección / Cómo llegar --}}
         <div class="header-location-bar">
            <div class="container">
                <a href="https://www.google.com/maps/place/Villaverde+Bajo+Butarque"
                class="header-location-link"
                target="_blank" rel="noopener">
                    <i class="bi bi-geo-alt-fill location-icon"></i>

                    <span class="location-main">
                        Villaverde Bajo – Butarque, Madrid
                    </span>

                    <span class="location-extra">
                        · Cómo llegar
                    </span>
                </a>
            </div>
        </div>

        {{-- Banda con logo + fondo instalaciones --}}
        <div class="header-top">
            <div class="container">
                <a href="{{ route('home') }}" class="header-brand">
                    <img
                        src="{{ asset('images/logo-templo-afrodita.png') }}"
                        alt="Masajes el Templo de Afrodita"
                        class="header-logo-icon-img">
                </a>
            </div>
        </div>

        {{-- NAV --}}
        <nav class="navbar navbar-expand-lg navbar-dark header-nav">
            <div class="container">
                <button class="navbar-toggler" type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#mainNavbar"
                        aria-controls="mainNavbar"
                        aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-center" id="mainNavbar">
                    <ul class="navbar-nav gap-lg-3">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                               href="{{ route('home') }}">
                                Inicio
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('services.*') ? 'active' : '' }}"
                               href="{{ route('services.index') }}">
                                Carta de Masajes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('masseuses.*') ? 'active' : '' }}"
                               href="{{ route('masseuses.index') }}">
                                Masajistas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('installations.*') ? 'active' : '' }}"
                               href="{{ route('installations.index') }}">
                                Instalaciones
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('jobs') ? 'active' : '' }}"
                               href="{{ route('jobs') }}">
                                Oferta de empleo
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}#contacto">
                                Contacto
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

@endif


{{-- Contenido principal --}}
<main>
    @yield('content')
    {{-- Botones flotantes de contacto (solo parte pública) --}}
    @if(!auth()->check() || !request()->is('admin*'))
        <div class="floating-contact">
            <a href="tel:+34674583265"
            class="floating-btn floating-btn-phone"
            aria-label="Llamar por teléfono">
                <i class="bi bi-telephone-fill"></i>
            </a>

            <a href="https://wa.me/34674583265"
            class="floating-btn floating-btn-whatsapp"
            aria-label="Escribir por WhatsApp">
                <i class="bi bi-whatsapp"></i>
            </a>

            <!-- 👉 NUEVO BOTÓN TELEGRAM -->
            <a href="https://t.me/Masajeseltemplodeafrodita"
            class="floating-btn floating-btn-telegram"
            aria-label="Abrir chat en Telegram">
                <i class="bi bi-telegram"></i>
            </a>
        </div>

    @endif
</main>

<footer id="footer" class="site-footer " role="contentinfo">
    <div class="footer-inner container">
        <div class="row gy-4">
            {{-- Columna 1: info del centro --}}
            <div class="col-md-4">
                <h6 class="footer-title">Masajes el Templo de Afrodita</h6>
                <p class="mb-2">
                    Espacio íntimo y discreto de masajes de bienestar y relajación.
                </p>
                <ul class="small text-muted mb-0 list-unstyled">
                    <li>Servicios exclusivos para personas mayores de 18 años.</li>
                    <li>No se ofrecen servicios de carácter sexual.</li>
                </ul>
            </div>

            {{-- Columna 2: ubicación --}}
            <div class="col-md-4">
                <h6 class="footer-title">Ubicación</h6>
                <p class="mb-1">
                    Villaverde Bajo – Butarque, 28021 (Madrid)
                </p>
                <p class="mb-0">
                    Horario: lunes a sábado
                </p>
            </div>

            {{-- Columna 3: contacto --}}
            <div class="col-md-4">
                <h6 class="footer-title">Contacto</h6>
                <p class="mb-1">
                    Tel / WhatsApp:
                    <a href="https://wa.me/34674583265" class="footer-link">
                        674 58 32 65
                    </a>
                </p>
                <p class="mb-0">
                    Email:
                    <a href="mailto:temploafrodita5@gmail.com" class="footer-link">
                        temploafrodita5@gmail.com
                    </a>
                </p>
            </div>
        </div>

        <div class="footer-bottom mt-4 py-3 d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
            <div class="footer-copy">
                &copy; {{ date('Y') }} Masajes el Templo de Afrodita
            </div>
            <div class="footer-meta">
                <a href="{{ url('/aviso-legal') }}" class="footer-meta-link">Aviso legal</a>
                <span class="footer-separator">·</span>
                <a href="{{ url('/privacidad') }}" class="footer-meta-link">Privacidad</a>
                <span class="footer-separator">·</span>
                <a href="{{ url('/cookies') }}" class="footer-meta-link">Cookies</a>
            </div>
        </div>
    </div>
</footer>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

{{-- Aquí se inyectan los scripts extra (por ejemplo, el modal de fotos) --}}
@stack('scripts')

</body>
</html>
