@extends('layouts.app')

@section('title', $masseuse->displayName().' · Masajes el templo de Afrodita')

@section('content')
<section class="section-masseuse-detail py-5">
    <div class="container">
        {{-- MIGAS DE PAN --}}
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Inicio</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('masseuses.index') }}">Masajistas</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ $masseuse->displayName() }}
                </li>
            </ol>
        </nav>

        <div class="row g-4">
            {{-- COLUMNA IZQUIERDA: FOTO PRINCIPAL + CTA --}}
            <div class="col-md-5">
                <article class="card shadow-sm masseuse-main-card h-100">
                    <figure class="masseuse-main-photo bg-secondary mb-0">
                        @if($masseuse->main_photo)
                            <img src="{{ asset('storage/'.$masseuse->main_photo) }}"
                                 alt="{{ $masseuse->displayName() }}"
                                 class="w-100 h-100 object-fit-cover"
                                 data-photo-full="{{ asset('storage/'.$masseuse->main_photo) }}">
                        @else
                            <div class="w-100 h-100 d-flex align-items-center justify-content-center text-white">
                                Sin foto disponible
                            </div>
                        @endif
                    </figure>

                    <div class="card-body d-flex flex-column">
                        <header class="mb-2">
                            <h1 class="h4 mb-1">{{ $masseuse->displayName() }}</h1>

                            @if($masseuse->age || $masseuse->nationality)
                                <p class="mb-2 text-muted">
                                    @if($masseuse->age)
                                        {{ $masseuse->age }} años
                                    @endif
                                    @if($masseuse->age && $masseuse->nationality) · @endif
                                    @if($masseuse->nationality)
                                        {{ $masseuse->nationality }}
                                    @endif
                                </p>
                            @endif
                        </header>

                        @if($masseuse->short_description)
                            <p class="mb-3">
                                {{ $masseuse->short_description }}
                            </p>
                        @endif

                        {{-- CTA: WhatsApp / carta de masajes --}}
                        @php
                            $whatsappText = urlencode(
                                'Hola, me gustaría recibir información sobre los masajes de bienestar con la masajista '
                                . $masseuse->displayName() . '.'
                            );
                        @endphp

                        <div class="d-grid gap-2 masseuse-cta">
                            @php
                                $whatsappText = urlencode(
                                    'Hola, me gustaría recibir información sobre los masajes de bienestar con la masajista '
                                    . $masseuse->name . '.'
                                );
                            @endphp

                            {{-- WhatsApp --}}
                            <a href="https://wa.me/34674583265?text={{ $whatsappText }}"
                            class="btn btn-whatsapp d-flex align-items-center justify-content-center">
                                <i class="bi bi-whatsapp me-2"></i>
                                Reservar con {{ $masseuse->name }}
                            </a>

                            {{-- Llamar ahora --}}
                            <a href="tel:+34674583265"
                            class="btn btn-outline-light d-flex align-items-center justify-content-center">
                                <i class="bi bi-telephone me-2"></i>
                                Llamar ahora
                            </a>

                            {{-- Ver tipos de masajes --}}
                            <a href="{{ route('services.index') }}"
                            class="btn btn-outline-primary">
                                Ver la carta de masajes
                            </a>
                        </div>




                        <p class="small text-muted mt-3 mb-0">
                            La reserva se gestiona siempre a través de Masajes el Templo de Afrodita, con un trato
                            cercano y discreto.
                            Servicios de masaje de bienestar y relajación, exclusivos para personas mayores de 18 años.
                            No se ofrecen servicios de carácter sexual.
                        </p>
                    </div>
                </article>
            </div>

            {{-- COLUMNA DERECHA: DESCRIPCIÓN + GALERÍA + AVISO LEGAL --}}
            <div class="col-md-7">
                {{-- DESCRIPCIÓN --}}
                <section class="mb-4">
                    <h2 class="h5 mb-3">Sobre {{ $masseuse->displayName() }}</h2>

                    @if($masseuse->long_description)
                        <div class="mb-3">
                            {!! nl2br(e($masseuse->long_description)) !!}
                        </div>
                    @elseif($masseuse->short_description)
                        <p>{{ $masseuse->short_description }}</p>
                    @else
                        <p class="text-muted">
                            Muy pronto compartiremos más detalles sobre {{ $masseuse->displayName() }}.
                        </p>
                    @endif

                    <p class="small text-muted mb-0">
                        Las sesiones con {{ $masseuse->displayName() }} están orientadas a la relajación,
                        el bienestar y el cuidado personal, con un enfoque sensorial y delicado.
                        No sustituyen tratamientos médicos ni fisioterapéuticos.
                    </p>
                </section>

                {{-- GALERÍA --}}
                @if($masseuse->photos->count())
                    <hr class="my-4">
                    <section class="mt-4">
                        <h2 class="h4 mb-3">Galería</h2>

                        <div id="masseuseGallery-{{ $masseuse->id }}" class="carousel slide" data-bs-ride="carousel">
                            {{-- Indicadores --}}
                            @if($masseuse->photos->count() > 1)
                                <div class="carousel-indicators">
                                    @foreach($masseuse->photos as $index => $photo)
                                        <button type="button"
                                                data-bs-target="#masseuseGallery-{{ $masseuse->id }}"
                                                data-bs-slide-to="{{ $index }}"
                                                class="{{ $index === 0 ? 'active' : '' }}"
                                                aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                                                aria-label="Foto {{ $index + 1 }}">
                                        </button>
                                    @endforeach
                                </div>
                            @endif

                            {{-- Slides --}}
                            <div class="carousel-inner">
                                @foreach($masseuse->photos as $index => $photo)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/'.$photo->path) }}"
                                             class="d-block w-100 masseuse-gallery-photo"
                                             alt="Foto de {{ $masseuse->displayName() }}"
                                             data-photo-full="{{ asset('storage/'.$photo->path) }}">
                                    </div>
                                @endforeach
                            </div>

                            {{-- Controles --}}
                            @if($masseuse->photos->count() > 1)
                                <button class="carousel-control-prev" type="button"
                                        data-bs-target="#masseuseGallery-{{ $masseuse->id }}"
                                        data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Anterior</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                        data-bs-target="#masseuseGallery-{{ $masseuse->id }}"
                                        data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Siguiente</span>
                                </button>
                            @endif
                        </div>
                    </section>
                @endif

                {{-- BLOQUE INFORMATIVO LEGAL --}}
                <section class="alert alert-light border mt-4" role="alert">
                    <h3 class="h6 mb-2">Información importante</h3>
                    <ul class="small mb-0">
                        <li>Servicios dirigidos exclusivamente a personas mayores de 18 años.</li>
                        <li>Los masajes son de bienestar y relajación, sin carácter sanitario.</li>
                        <li>No se ofrecen servicios de carácter sexual ni se realizan prácticas
                            que vulneren la normativa vigente en España.</li>
                        <li>
                            Para <strong>reservas</strong>, utiliza siempre WhatsApp
                            <strong> 674 58 32 65</strong>.
                            Para dudas administrativas, puedes escribir al email
                            <a href="mailto:temploafrodita5@gmail.com">temploafrodita5@gmail.com</a>.
                        </li>
                    </ul>
                </section>
            </div>
        </div>
    </div>

    {{-- Modal para ver fotos en grande --}}
    <div class="modal fade" id="photoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-dark">
                <div class="modal-body p-0">
                    <img src="" alt="Foto ampliada" class="w-100" id="photoModalImage">
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const modalElement = document.getElementById('photoModal');
                const modalImage  = document.getElementById('photoModalImage');
                if (!modalElement || !modalImage) return;

                const photoModal = new bootstrap.Modal(modalElement);

                document.querySelectorAll('[data-photo-full]').forEach(function (el) {
                    el.addEventListener('click', function () {
                        const src = el.getAttribute('data-photo-full');
                        if (!src) return;
                        modalImage.src = src;
                        photoModal.show();
                    });
                });
            });
        </script>
    @endpush
</section>
@endsection
