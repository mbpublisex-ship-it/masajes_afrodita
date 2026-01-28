{{-- resources/views/services/index.blade.php --}}
@php use Illuminate\Support\Str; @endphp

@extends('layouts.app')

@section('title', 'Carta de Masajes · Masajes el Templo de Afrodita')

@section('content')
<section class="section-services py-5">
    <div class="container">

        {{-- CABECERA DE LA PÁGINA --}}
        <div class="section-block mb-4">
            <div class="row g-4 align-items-center">
                <div class="col-lg-7 text-center text-lg-start">
                    <p class="section-kicker">Carta de masajes</p>
                    <h1 class="mb-3">Nuestros masajes de bienestar</h1>
                    <p class="lead text-muted mb-0">
                        Rituales sensoriales pensados para que te sueltes, calmes la mente
                        y cuides tu cuerpo en un ambiente íntimo, elegante y respetuoso.
                        {{-- Opción 2: Masajes diseñados para desconectar, respirar profundo y mimar el cuerpo en un entorno íntimo y respetuoso. --}}
                    </p>
                </div>

                <div class="col-lg-5 d-none d-lg-block">
                    <div class="services-hero-image">
                        <img
                            src="{{ asset('images/instalaciones/instalacion-03.jpg') }}"
                            alt="Sala de masaje del Templo de Afrodita, con camilla, velas e iluminación cálida">
                    </div>
                </div>
            </div>
        </div>

        {{-- LISTADO DE MASAJES --}}
        @if($services->isEmpty())
            <p class="text-center text-muted">
                Muy pronto añadiremos todos los masajes disponibles en nuestra carta.
            </p>
        @else
            <div class="row g-4">
                @foreach($services as $service)
                    <div class="col-lg-4 col-md-6">
                        <article class="card service-card h-100">
                            {{-- IMAGEN DEL MASAJE --}}
                            @if($service->image)
                                <div class="service-card-image">
                                    <img
                                        src="{{ asset('storage/'.$service->image) }}"
                                        alt="{{ $service->name }}">
                                </div>
                            @else
                                {{-- Fallback opcional, puedes dejarlo o quitarlo --}}
                                <div class="service-card-image service-card-image--fallback"></div>
                            @endif

                            <div class="card-body d-flex flex-column">
                                <h2 class="h5 card-title mb-2">
                                    {{ $service->name }}
                                </h2>

                                {{-- Meta: duración + precio con iconos --}}
                                @if($service->duration_minutes || $service->base_price)
                                    <p class="service-meta small text-muted mb-3">
                                        @if($service->duration_minutes)
                                            <span class="service-meta-item me-3">
                                                <i class="bi bi-clock service-meta-icon"></i>
                                                {{ $service->duration_minutes }} min
                                            </span>
                                        @endif

                                        @if($service->base_price)
                                            <span class="service-meta-item">
                                                <i class="bi bi-cash-coin service-meta-icon"></i>
                                                desde
                                                <strong>
                                                    {{ number_format($service->base_price, 2, ',', '.') }} €
                                                </strong>
                                            </span>
                                        @endif
                                    </p>
                                @endif

                                @if($service->short_description)
                                    <p class="card-text mb-0 flex-grow-1">
                                        {{ Str::limit($service->short_description, 160) }}
                                    </p>
                                @endif

                                <a href="{{ route('services.show', $service->slug) }}"
                                   class="btn btn-outline-primary mt-3 align-self-start">
                                    Ver detalles
                                </a>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
