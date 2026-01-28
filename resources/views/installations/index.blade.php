@extends('layouts.app')

@section('title', 'Instalaciones · Masajes el Templo de Afrodita')

@section('content')
    <section class="section-inst py-5">
        <div class="container">

            {{-- TITULAR + TEXTO --}}
            <div class="row justify-content-center mb-4">
                <div class="col-lg-12">
                    <p class="section-kicker text-md-center">El espacio</p>
                    <h1 class="mb-3 text-center">Nuestras instalaciones</h1>

                    <p class="mb-3">
                        En <strong>Masajes el Templo de Afrodita</strong> hemos creado un refugio íntimo,
                        sereno y cuidado al detalle para que desconectes desde el primer momento.
                    </p>

                    <p class="mb-3">
                        Iluminación cálida, velas, aromas suaves y una decoración con toques orientales hacen
                        que cada sala esté pensada para el bienestar y la relajación, siempre en un entorno
                        discreto, elegante y acogedor.
                    </p>

                    <ul class="mb-3">
                        <li>Salas amplias con camilla, toallas y material siempre limpio.</li>
                        <li>Iluminación tenue y velas para un ambiente sensorial y envolvente.</li>
                        <li>Detalles decorativos que invitan a la calma, la respiración y el descanso.</li>
                        <li>Zona de recepción discreta y atención personalizada.</li>
                    </ul>

                    <p class="small text-muted mb-0">
                        Todas las sesiones son con cita previa para garantizar tranquilidad y privacidad en
                        cada masaje.
                    </p>
                </div>
            </div>

            {{-- GALERÍA: FOTOS GRANDES (2 columnas en desktop, 1 en móvil) --}}
            <div class="inst-gallery-vertical">
                <div class="inst-photo-vertical">
                    <img src="{{ asset('images/instalaciones/instalacion-01.jpg') }}" alt="Instalaciones 1">
                </div>
                <div class="inst-photo-vertical">
                    <img src="{{ asset('images/instalaciones/instalacion-02.jpg') }}" alt="Instalaciones 2">
                </div>
                <div class="inst-photo-vertical">
                    <img src="{{ asset('images/instalaciones/instalacion-03.jpg') }}" alt="Instalaciones 3">
                </div>
                <div class="inst-photo-vertical">
                    <img src="{{ asset('images/instalaciones/instalacion-04.jpg') }}" alt="Instalaciones 4">
                </div>
                <div class="inst-photo-vertical">
                    <img src="{{ asset('images/instalaciones/instalacion-05.jpg') }}" alt="Instalaciones 5">
                </div>
                <div class="inst-photo-vertical">
                    <img src="{{ asset('images/instalaciones/instalacion-06.jpg') }}" alt="Instalaciones 6">
                </div>
                <div class="inst-photo-vertical">
                    <img src="{{ asset('images/instalaciones/instalacion-07.jpg') }}" alt="Instalaciones 7">
                </div>
                <div class="inst-photo-vertical">
                    <img src="{{ asset('images/instalaciones/instalacion-08.jpg') }}" alt="Instalaciones 8">
                </div>
                <div class="inst-photo-vertical">
                    <img src="{{ asset('images/instalaciones/instalacion-09.jpg') }}" alt="Instalaciones 9">
                </div>
                <div class="inst-photo-vertical">
                    <img src="{{ asset('images/instalaciones/instalacion-10.jpg') }}" alt="Instalaciones 10">
                </div>
            </div>

            {{-- CTA FINAL: WHATSAPP + LLAMADA --}}
            @php
                $waTextInstalaciones = urlencode(
                    'Hola, me gustaría reservar un masaje en Masajes el Templo de Afrodita. He visto las instalaciones en la web.'
                );
            @endphp

            <div class="text-center mt-5">
                <h2 class="h5 mb-2">¿Te apetece vivir el Templo de Afrodita?</h2>
                <p class="mb-4">
                    Si deseas vivir la experiencia, escríbenos por WhatsApp o llámanos y te informamos sin compromiso.
                </p>

                <div class="d-inline-flex flex-wrap justify-content-center gap-3">
                    <a href="https://wa.me/34674583265?text={{ $waTextInstalaciones }}"
                       class="btn btn-whatsapp">
                        <i class="bi bi-whatsapp me-2"></i>
                        Escribir por WhatsApp
                    </a>

                    <a href="tel:+34674583265" class="btn btn-outline-light">
                        Llamar ahora
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
