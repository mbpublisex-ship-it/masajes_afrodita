@extends('layouts.app')

@section('title', 'Nueva masajista')

@section('content')
<div class="container py-4">
    <h1 class="h3 mb-3">Crear masajista</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.masseuses.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.masseuses.partials.form', ['masseuse' => null])
        <button type="submit" class="btn btn-primary mt-3">Guardar</button>
    </form>
</div>
@endsection
