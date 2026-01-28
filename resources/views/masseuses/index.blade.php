@php use Illuminate\Support\Str; @endphp

@extends('layouts.app')

@section('title', 'Masajistas · Masajes el templo de Afrodita')

@section('content')
<section class="section-masseuses py-5">
    <div class="container">
        <div class="text-center mb-4">
            <p class="section-kicker">Nuestro equipo</p>
            <h1 class="mb-2">Nuestras masajistas</h1>
            <p class="text-muted mb-0">
                Masajistas de bienestar formadas para ofrecerte sesiones envolventes,
                cercanas y respetuosas en un entorno íntimo y cuidado.
            </p>
        </div>

        @if ($masseuses->isEmpty())
            <p class="text-center text-muted">
                Muy pronto conocerás a todas las masajistas del templo.
            </p>
        @else
            <div class="row g-4">
                @foreach ($masseuses as $masseuse)
                    <div class="col-lg-4 col-md-6">
                        <article class="card masseuse-card h-100">
                            <div class="card-img-wrap">
                                @if ($masseuse->main_photo)
                                    <img src="{{ asset('storage/'.$masseuse->main_photo) }}"
                                         alt="{{ $masseuse->displayName() }}"
                                         class="w-100 h-100 object-fit-cover">
                                @else
                                    <div class="no-photo text-white">
                                        Sin foto
                                    </div>
                                @endif
                            </div>

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title mb-1">
                                    {{ $masseuse->displayName() }}
                                </h5>

                                @if ($masseuse->age || $masseuse->nationality)
                                    <p class="card-text text-muted mb-2">
                                        @if ($masseuse->age)
                                            {{ $masseuse->age }} años
                                        @endif
                                        @if ($masseuse->age && $masseuse->nationality) · @endif
                                        @if ($masseuse->nationality)
                                            {{ $masseuse->nationality }}
                                        @endif
                                    </p>
                                @endif

                                @if ($masseuse->short_description)
                                    <p class="card-text small mb-3">
                                        {{ Str::limit($masseuse->short_description, 110) }}
                                    </p>
                                @endif

                                <div class="mt-auto">
                                    <a href="{{ route('masseuses.show', $masseuse->slug) }}"
                                       class="btn btn-primary w-100">
                                        Ver ficha
                                    </a>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>

            <div class="mt-4 d-flex justify-content-center">
                {{ $masseuses->links() }}
            </div>
        @endif
    </div>
</section>
@endsection
