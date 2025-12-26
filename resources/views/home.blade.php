@extends('layouts.app')

@section('title', 'Inicio · Masajes el templo de Afrodita')

@section('content')
    @php use Illuminate\Support\Str; @endphp

    {{-- HERO --}}
    <header class="hero text-light d-flex align-items-center">
        <div class="container pt-5">
            <div class="row align-items-center g-4">
                <div class="col-md-7">
                    <h1 class="hero-title fw-bold mb-3">
                        Masajes sensoriales de bienestar en Villaverde Bajo – Butarque (Madrid)
                    </h1>

                    <p class="lead mb-4">
                        Un espacio íntimo y tranquilo donde cada sesión está pensada para que desconectes del estrés
                        diario y te centres en tu descanso y bienestar.
                    </p>
                    <a href="#masseuses" class="btn btn-primary btn-lg me-2">
                        Ver masajistas
                    </a>
                    <a href="#contacto" class="btn btn-outline-light btn-lg">
                        Solicitar reserva
                    </a>
                </div>
                <div class="col-md-5 d-none d-md-block">
                    <div class="hero-image-placeholder">
                        <img
                            src="{{ asset('images/instalaciones/instalacion-03.jpg') }}"
                            alt="Sala de masaje iluminada en tonos cálidos en el Templo de Afrodita">
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- SOBRE EL ESPACIO --}}
    <section id="sobre" class="pt-5 section-about">
        <div class="container">
            <div class="section-block">
                <div class="row g-4 align-items-center">
                    <div class="col-md-5">
                        <div class="section-image-placeholder">
                            <img
                                src="{{ asset('images/instalaciones/instalacion-06.jpg') }}"
                                alt="Pasillo del Templo de Afrodita con buda y velas en un ambiente relajante"
                                loading="lazy">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <p class="section-kicker">El espacio</p>
                        <h2 class="mb-3">El templo de Afrodita</h2>
                        <p>
                            Masajes el Templo de Afrodita es un espacio de masajes de bienestar ubicado en Villaverde Bajo –
                            Butarque (28021, Madrid), pensado para personas adultas que buscan un momento de calma, desconexión
                            y cuidado personal en un ambiente íntimo y discreto.
                        </p>
                        <p>
                            Nuestras masajistas combinan técnicas de masaje relajante y sensorial para ayudarte a liberar
                            tensiones físicas y mentales, siempre desde el respeto, la cercanía y la profesionalidad.
                        </p>
                        <p class="small text-muted mb-0">
                            Los servicios que se ofrecen son exclusivamente de bienestar y relajación, sin carácter sanitario
                            y sin prestación de servicios de índole sexual. No sustituyen en ningún caso tratamientos médicos
                            o fisioterapéuticos.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- MASAJISTAS DESTACADAS --}}
    <section id="masseuses" class="pt-5 section-masseuses">
        <div class="container">
            <div class="section-block">
                <p class="section-kicker text-md-center">Nuestro equipo</p>
                <h2 class="mb-4 text-md-center">Nuestras masajistas</h2>

                @if($masseuses->isEmpty())
                    <p class="text-center text-muted mb-0">
                        Pronto verás aquí a nuestras masajistas disponibles.
                    </p>
                @else
                    <div class="row g-4">
                        @foreach($masseuses as $masseuse)
                            <div class="col-lg-4 col-md-6">
                                <div class="card h-100 shadow-sm masseuse-card">
                                    <div class="card-img-wrap">
                                        @if($masseuse->main_photo)
                                            <img
                                                src="{{ asset('storage/'.$masseuse->main_photo) }}"
                                                alt="{{ $masseuse->name }}"
                                                class="w-100 h-100 object-fit-cover"
                                                loading="lazy">
                                        @else
                                            <div class="no-photo text-white">
                                                Sin foto
                                            </div>
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $masseuse->name }}</h5>

                                        @if($masseuse->age || $masseuse->nationality)
                                            <p class="card-text text-muted mb-1">
                                                @if($masseuse->age)
                                                    {{ $masseuse->age }} años
                                                @endif
                                                @if($masseuse->age && $masseuse->nationality) · @endif
                                                @if($masseuse->nationality)
                                                    {{ $masseuse->nationality }}
                                                @endif
                                            </p>
                                        @endif

                                        @if($masseuse->short_description)
                                            <p class="card-text small mb-0">
                                                {{ Str::limit($masseuse->short_description, 80) }}
                                            </p>
                                        @endif
                                    </div>
                                    <div class="card-footer bg-transparent border-0">
                                        <a href="{{ route('masseuses.show', $masseuse->slug) }}"
                                           class="btn btn-primary w-100">
                                            Ver ficha
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- SERVICIOS --}}
    <section id="services" class="py-5 section-services">
    <div class="container">
        <div class="section-block">
            <p class="section-kicker text-md-center">Carta de masajes</p>
            <h2 class="mb-4 text-md-center">Tipos de masajes</h2>

            @php
                // Solo mostramos los 3 primeros en la home
                $servicesHome = $services->take(4);
            @endphp

            @if($servicesHome->isEmpty())
                <p class="text-center text-muted mb-0">
                    Pronto detallaremos todos nuestros servicios.
                </p>
            @else
                <div class="row g-4">
                    @foreach($servicesHome as $service)
                        <div class="col-lg-3 col-md-6">
                            <div class="card h-100 shadow-sm service-card">

                                {{-- Imagen del servicio --}}
                                @if($service->image)
                                    <div class="service-card-image">
                                        <img
                                            src="{{ asset('storage/'.$service->image) }}"
                                            alt="Ambiente del masaje {{ $service->name }} en el Templo de Afrodita">
                                    </div>
                                @else
                                    <div class="service-card-image service-card-image--fallback"></div>
                                @endif

                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $service->name }}</h5>

                                    @if($service->duration_minutes || $service->base_price)
                                        <p class="card-text text-muted mb-1">
                                            @if($service->duration_minutes)
                                                {{ $service->duration_minutes }} min
                                            @endif
                                            @if($service->duration_minutes && $service->base_price) · @endif
                                            @if($service->base_price)
                                                desde {{ number_format($service->base_price, 2, ',', '.') }} €
                                            @endif
                                        </p>
                                    @endif

                                    @if($service->short_description)
                                        <p class="card-text small mb-0">
                                            {{ $service->short_description }}
                                        </p>
                                    @endif
                                </div>

                                <div class="card-footer bg-transparent border-0">
                                    <a href="{{ route('services.show', $service->slug) }}"
                                       class="btn btn-outline-primary w-100">
                                        Ver detalles
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Botón para ver todo el listado --}}
                <div class="text-center mt-4">
                    <a href="{{ route('services.index') }}" class="btn btn-outline-light">
                        Ver toda la carta de masajes
                    </a>
                </div>
            @endif
        </div>
    </div>
</section>


    {{-- INSTALACIONES (TEASER) --}}
    <section class="pb-5 section-inst">
        <div class="container">
            <div class="section-block">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-6">
                        <p class="section-kicker text-md-start mb-2">Instalaciones</p>
                        <h2 class="mb-3">Nuestras instalaciones</h2>
                        <p class="mb-3">
                            Un espacio íntimo y cuidado al detalle, con salas preparadas para masajes
                            de bienestar y relajación en un ambiente tranquilo y discreto.
                        </p>
                        <p class="mb-4">
                            Iluminación cálida, velas, aromas suaves y decoración con toques orientales
                            para ayudarte a desconectar desde el primer minuto.
                        </p>

                        <a href="{{ route('installations.index') }}" class="btn btn-outline-light">
                            Ver todas las instalaciones
                        </a>
                    </div>

                    <div class="col-lg-6">
                        <div class="inst-teaser-image">
                            <img src="{{ asset('images/instalaciones/instalacion-02.jpg') }}"
                                alt="Sala de masaje en el Templo de Afrodita">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- CONTACTO / RESERVA --}}
    <section id="contacto" class="py-5 section-contact">
        <div class="container">
            <div class="section-block">
                <p class="section-kicker text-md-center">Contacto</p>
                <h2 class="mb-3 text-md-center">Solicita tu masaje</h2>

                <div class="row g-4 align-items-start">
                    {{-- COLUMNA IZQUIERDA: INFO + BOTONES --}}
                    <div class="col-lg-6">
                        <p class="mb-3">
                            Indícanos por teléfono o WhatsApp el tipo de masaje que te interesa
                            y el horario aproximado que prefieres. Te responderemos para confirmar
                            la cita y resolver cualquier duda.
                        </p>

                        <p class="mb-2">
                            <strong>Masajes el Templo de Afrodita</strong><br>
                            Villaverde Bajo – Butarque, 28021 (Madrid)
                        </p>
                        <p class="mb-2">
                            <strong>Teléfono / WhatsApp:</strong> 674 58 32 65
                        </p>
                        <p class="mb-3">
                            <strong>Horario:</strong> lunes a sábado
                        </p>

                        <div class="d-flex flex-wrap gap-3 mb-4">
                            {{-- WhatsApp directo (con texto por defecto) --}}
                            <a href="https://wa.me/34674583265?text={{ rawurlencode('Hola, me gustaría reservar un masaje de bienestar. Vengo desde la web del Templo de Afrodita.') }}"
                               class="btn btn-whatsapp btn-lg d-inline-flex align-items-center gap-2">
                                <i class="bi bi-whatsapp"></i>
                                <span>Escribir por WhatsApp</span>
                            </a>

                            {{-- Llamada directa --}}
                            <a href="tel:+34674583265"
                               class="btn btn-outline-light btn-lg d-inline-flex align-items-center gap-2">
                                <i class="bi bi-telephone"></i>
                                <span>Llamar ahora</span>
                            </a>
                        </div>

                        <p class="mb-2"><strong>Síguenos:</strong></p>
                        <ul class="list-unstyled mb-3 contact-social-list">
                            <li class="mb-1">
                                <span class="contact-social-icon">
                                    <i class="bi bi-instagram"></i>
                                </span>
                                <a href="https://instagram.com/templodeafrodita2025"
                                   target="_blank" class="footer-link">
                                    @templodeafrodita2025
                                </a>
                            </li>
                            <li class="mb-1">
                                <span class="contact-social-icon">
                                    <i class="bi bi-tiktok"></i>
                                </span>
                                <a href="https://www.tiktok.com/@eltemplodeafrodita"
                                   target="_blank" class="footer-link">
                                    @eltemplodeafrodita
                                </a>
                            </li>
                            <li class="mb-1">
                                <span class="contact-social-icon">
                                    <i class="bi bi-telegram"></i>
                                </span>
                                <a href="https://t.me/Masajeseltemplodeadrodita"
                                   target="_blank" class="footer-link">
                                    @Masajeseltemplodeadrodita
                                </a>
                            </li>
                        </ul>

                        <ul class="small text-muted mb-0 ps-3">
                            <li>Servicios exclusivos para personas mayores de 18 años.</li>
                            <li>Masajes de bienestar y relajación, sin carácter sexual ni sanitario.</li>
                        </ul>
                    </div>

                    {{-- COLUMNA DERECHA: PISTAS PARA EL MENSAJE --}}
                    <div class="col-lg-6">
                        <div class="contact-hints">
                            <h3 class="h5 mb-3">¿Qué puedes indicarnos al escribir?</h3>
                            <p class="mb-2">
                                Para darte una respuesta rápida y clara, nos ayuda que nos digas:
                            </p>
                            <ul class="mb-3">
                                <li>Día y franja horaria que te viene mejor.</li>
                                <li>Si tienes preferencia por alguna masajista.</li>
                                <li>Tipo de masaje de bienestar que te interesa.</li>
                            </ul>
                            <p class="small text-muted mb-0">
                                Todas las reservas se gestionan de forma personal por teléfono o WhatsApp,
                                sin formularios automáticos ni pagos online.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
