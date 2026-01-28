@extends('layouts.app')

@section('title', 'Oferta de empleo · Masajes el Templo de Afrodita')

@section('content')
    <section class="section-jobs py-5">
        <div class="container">

            {{-- CABECERA TEXTO --}}
            <div class="row justify-content-center mb-4">
                <div class="col-lg-12">
                    <p class="section-kicker text-md-center">Trabaja con nosotras</p>
                    <h1 class="mb-3 text-md-center">Oferta de empleo para masajistas</h1>

                    <p class="mb-3">
                        En <strong>Masajes el Templo de Afrodita</strong> buscamos
                        <strong>masajistas (solo mujeres)</strong> para un espacio íntimo y discreto
                        especializado en masajes de bienestar y relajación en Villaverde Bajo – Butarque (Madrid).
                    </p>

                    <p class="mb-3">
                        No es imprescindible experiencia previa en masajes: se valora, pero lo más importante
                        es la buena actitud, la imagen cuidada, la discreción y las ganas de trabajar en un entorno
                        respetuoso, elegante y cálido.
                    </p>
                </div>
            </div>

            {{-- CONTENIDO A DOS COLUMNAS --}}
            <div class="row g-4 align-items-start">
                {{-- REQUISITOS Y DETALLES --}}
                <div class="col-lg-7">
                    <div class="section-block">
                        <h2 class="h5 mb-3">Requisitos básicos</h2>
                        <ul class="mb-3">
                            <li>Mujeres mayores de 18 años.</li>
                            <li>Buena presencia, higiene y trato educado.</li>
                            <li>Discreción y seriedad con los horarios.</li>
                            <li>Se valora experiencia en masajes relajantes o similar (no imprescindible).</li>
                        </ul>

                        <h2 class="h5 mb-3">Sobre el tipo de masajes</h2>
                        <p class="mb-3">
                            El centro está enfocado en <strong>masajes de bienestar y relajación</strong>,
                            con un enfoque sensorial y cuidado.
                            No se ofrecen servicios de carácter sexual ni se realizan prácticas que vulneren
                            la normativa vigente en España.
                        </p>

                        <p class="small text-muted mb-0">
                            La información que nos facilites se utilizará únicamente para valorar tu perfil
                            como candidata al centro de masajes.
                        </p>
                    </div>
                </div>

                {{-- COLUMNA DERECHA: QUÉ OFRECEN + CTA --}}
                <div class="col-lg-5">
                    @php
                        $waTextEmpleo = urlencode(
                            'Hola, he visto la oferta de empleo para masajista en la web de Masajes el Templo de Afrodita y me gustaría recibir más información.'
                        );
                    @endphp

                    <div class="job-highlight">
                        <h2 class="h6 mb-3">¿Qué ofrecemos?</h2>
                        <ul class="mb-3">
                            <li>Ambiente discreto, cuidado y acogedor.</li>
                            <li>Citas siempre con reserva previa.</li>
                            <li>Trabajo por turnos según disponibilidad.</li>
                            <li>Acompañamiento para aprender la dinámica del centro.</li>
                        </ul>

                        <p class="mb-3">
                            Si te interesa, puedes escribirnos por WhatsApp indicando:
                        </p>
                        <ul class="mb-3">
                            <li>Tu nombre y edad.</li>
                            <li>Zona donde vives.</li>
                            <li>Si tienes o no experiencia previa.</li>
                        </ul>

                        <div class="d-grid gap-2">
                            <a href="https://wa.me/34674583265?text={{ $waTextEmpleo }}"
                               class="btn btn-whatsapp">
                                <i class="bi bi-whatsapp me-2"></i>
                                Escribir por WhatsApp
                            </a>

                            <a href="tel:+34674583265" class="btn btn-outline-light">
                                Llamar ahora
                            </a>
                        </div>

                        <p class="small text-muted mt-3 mb-0">
                            Responderemos tu mensaje lo antes posible para darte más detalles sobre la
                            forma de trabajo y los turnos disponibles.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
