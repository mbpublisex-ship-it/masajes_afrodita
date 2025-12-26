@extends('layouts.app')

@section('title', $service->name.' · Masajes el templo de Afrodita')

@section('content')
@php
    $waText = "Hola, me gustaría reservar el masaje \"{$service->name}\" en Masajes el Templo de Afrodita. Día orientativo: ___ / Franja horaria: ___ .";
@endphp

<div class="container py-5 service-show">

    {{-- MIGAS DE PAN --}}
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('home') }}">Inicio</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('services.index') }}">Carta de masajes</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                {{ $service->name }}
            </li>
        </ol>
    </nav>

    <div class="row g-5">

        {{-- COLUMNA IZQUIERDA: info + imagen --}}
        <div class="col-lg-8">
            <h1 class="mb-3">{{ $service->name }}</h1>

            @if($service->duration_minutes || $service->base_price)
                <p class="service-meta text-muted mb-3">
                    @if($service->duration_minutes)
                        <span class="service-meta-item me-3">
                            <i class="bi bi-clock service-meta-icon"></i>
                            Duración aproximada:
                            <strong>{{ $service->duration_minutes }} minutos</strong>
                        </span>
                    @endif

                    @if(!is_null($service->base_price))
                        <span class="service-meta-item">
                            <i class="bi bi-cash-coin service-meta-icon"></i>
                            Precio desde:
                            <strong>{{ number_format($service->base_price, 2, ',', '.') }} €</strong>
                        </span>
                    @endif
                </p>
            @endif

            {{-- Imagen del masaje (debajo de meta) --}}
            @if(!empty($service->image))
                <div class="service-image-wrapper mb-4">
                    <img
                        src="{{ asset('storage/'.$service->image) }}"
                        alt="Ambiente del {{ $service->name }} en Masajes el Templo de Afrodita"
                        class="img-fluid rounded-3"
                    >
                </div>
            @else
                <div class="service-image-wrapper mb-4">
                    <div class="service-image-placeholder rounded-3"></div>
                </div>
            @endif

            {{-- Descripción --}}
            @if($service->long_description)
                <div class="mb-4">
                    {!! nl2br(e($service->long_description)) !!}
                </div>
            @elseif($service->short_description)
                <div class="mb-4">
                    <p>{{ $service->short_description }}</p>
                </div>
            @endif

            {{-- Aviso legal --}}
            <p class="small text-muted mb-0">
                Este masaje es exclusivamente de bienestar, no sanitario.
                No se ofrecen servicios de carácter médico, fisioterapéutico ni sexuales.
            </p>

            {{-- Botón volver --}}
            <a href="{{ route('services.index') }}"
               class="btn btn-outline-secondary btn-back mt-3">
                ← Volver a la carta de masajes
            </a>
        </div>

        {{-- COLUMNA DERECHA: reserva por WhatsApp / teléfono --}}
        <div class="col-lg-4">
            <div class="card shadow-sm service-contact-card">
                <div class="card-body">
                    <h2 class="h5 mb-3">Reservar este masaje</h2>
                    <p class="small text-muted">
                        Todas las reservas se gestionan personalmente por teléfono o WhatsApp.
                        No utilizamos formularios ni correo electrónico.
                    </p>

                    <div class="d-flex flex-column gap-2 my-4">
                        <a
                            href="https://wa.me/34674583265?text={{ urlencode($waText) }}"
                            class="btn btn-whatsapp w-100 d-inline-flex align-items-center justify-content-center"
                        >
                            <i class="bi bi-whatsapp me-2"></i>
                            Escribir por WhatsApp
                        </a>

                        <a href="tel:+34674583265"
                           class="btn btn-outline-light w-100 d-inline-flex align-items-center justify-content-center">
                            <i class="bi bi-telephone me-2"></i>
                            Llamar ahora
                        </a>
                    </div>

                    <p class="small text-muted mb-0">
                        Al escribirnos, nos ayuda que indiques:
                        día orientativo, franja horaria que te viene mejor
                        y, si lo deseas, masajista favorita.
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
