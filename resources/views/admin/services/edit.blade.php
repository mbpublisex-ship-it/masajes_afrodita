@extends('layouts.app')

@section('title', 'Editar servicio: '.$service->name)

@section('content')
<div class="container py-4">
    <h1 class="h3 mb-3">Editar servicio</h1>

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

    <form action="{{ route('admin.services.update', $service) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('admin.services.partials.form', ['service' => $service])

        <button type="submit" class="btn btn-primary mt-3">
            Actualizar
        </button>
    </form>
</div>
@endsection
