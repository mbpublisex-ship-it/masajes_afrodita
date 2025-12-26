@extends('layouts.app')

@section('title', 'Admin · Masajistas')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Masajistas</h1>
        <a href="{{ route('admin.masseuses.create') }}" class="btn btn-primary">Nueva masajista</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($masseuses->isEmpty())
        <p class="text-muted">No hay masajistas todavía.</p>
    @else
        <table class="table table-borderless align-middle admin-table">
            <thead>
                <tr>
                    <th style="width: 90px;">Foto</th>
                    <th>Nombre</th>
                    <th>Edad</th>
                    <th>Nacionalidad</th>
                    <th>Activa</th>
                    <th>Slug</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($masseuses as $masseuse)
                    <tr>
                        <td>
                            @if($masseuse->main_photo)
                                <div class="admin-thumb">
                                    <img src="{{ asset('storage/'.$masseuse->main_photo) }}"
                                         alt="Foto de {{ $masseuse->name }}">
                                </div>
                            @else
                                <div class="admin-thumb d-flex align-items-center justify-content-center admin-thumb--empty">
                                    Sin foto
                                </div>
                            @endif
                        </td>
                        <td>{{ $masseuse->name }}</td>
                        <td>{{ $masseuse->age }}</td>
                        <td>{{ $masseuse->nationality }}</td>
                        <td>
                            @if($masseuse->is_active)
                                <span class="badge bg-success">Sí</span>
                            @else
                                <span class="badge bg-secondary">No</span>
                            @endif
                        </td>
                        <td>{{ $masseuse->slug }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.masseuses.edit', $masseuse) }}"
                               class="btn btn-sm btn-outline-primary">Editar</a>
                            <form action="{{ route('admin.masseuses.destroy', $masseuse) }}"
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('¿Eliminar esta masajista?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
