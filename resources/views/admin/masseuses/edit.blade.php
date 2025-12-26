@extends('layouts.app')

@section('title', 'Editar '.$masseuse->name)

@section('content')
<div class="container py-4">
    <h1 class="h3 mb-3">Editar masajista</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.masseuses.update', $masseuse) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.masseuses.partials.form', ['masseuse' => $masseuse])
        <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
    </form>

    @if($masseuse->photos->count())
        <hr class="my-4">
        <h2 class="h5 mb-3">Galería actual</h2>
        <div class="row g-3">
            @foreach($masseuse->photos as $photo)
                <div class="col-6 col-md-3">
                    <div class="card">
                        <img src="{{ asset('storage/'.$photo->path) }}"
                            class="card-img-top"
                            alt="Foto de {{ $masseuse->name }}">

                        <div class="card-body p-2">
                            <form action="{{ route('admin.masseuses.photos.destroy', [$masseuse, $photo]) }}"
                                method="POST"
                                onsubmit="return confirm('¿Eliminar esta foto?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger w-100">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif



</div>
@endsection
