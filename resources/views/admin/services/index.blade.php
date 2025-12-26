@extends('layouts.app')

@section('title', 'Admin · Servicios')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Servicios</h1>
        <a href="{{ route('admin.services.create') }}" class="btn btn-primary">Nuevo servicio</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($services->isEmpty())
        <p class="text-muted">No hay servicios creados todavía.</p>
    @else
        <table class="table table-borderless align-middle admin-table">
            <thead>
                <tr>
                    <th style="width: 90px;">Imagen</th>
                    <th>Orden</th>
                    <th>Nombre</th>
                    <th>Duración</th>
                    <th>Precio base</th>
                    <th>Activo</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                    <tr>
                        <td>
                            @if($service->image)
                                <div class="admin-thumb">
                                    <img src="{{ asset('storage/'.$service->image) }}"
                                         alt="Imagen {{ $service->name }}">
                                </div>
                            @else
                                <div class="admin-thumb d-flex align-items-center justify-content-center admin-thumb--empty">
                                    Sin imagen
                                </div>
                            @endif
                        </td>
                        <td>{{ $service->sort_order }}</td>
                        <td>{{ $service->name }}</td>
                        <td>{{ $service->duration_minutes ? $service->duration_minutes.' min' : '-' }}</td>
                        <td>
                            @if(!is_null($service->base_price))
                                {{ number_format($service->base_price, 2, ',', '.') }} €
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if($service->is_active)
                                <span class="badge bg-success">Sí</span>
                            @else
                                <span class="badge bg-secondary">No</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.services.edit', $service) }}"
                               class="btn btn-sm btn-outline-primary">Editar</a>
                            <form action="{{ route('admin.services.destroy', $service) }}"
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('¿Eliminar este servicio?');">
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
