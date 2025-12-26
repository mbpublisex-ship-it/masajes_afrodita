@extends('layouts.app')

@section('title', 'Nuevo servicio')

@section('content')
<div class="container py-4">
    <h1 class="h3 mb-3">Crear servicio</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.services.store') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf

        @include('admin.services.partials.form', [
            'service' => new \App\Models\Service()
        ])

        <button type="submit" class="btn btn-primary mt-3">
            Guardar
        </button>
    </form>
</div>
@endsection
