<div class="row g-3">
    {{-- Nombre / Slug --}}
    <div class="col-md-6">
        <label class="form-label">Nombre *</label>
        <input
            type="text"
            name="name"
            class="form-control"
            value="{{ old('name', $service->name ?? '') }}"
            required
        >
    </div>

    <div class="col-md-6">
        <label class="form-label">Slug (opcional)</label>
        <input
            type="text"
            name="slug"
            class="form-control"
            value="{{ old('slug', $service->slug ?? '') }}"
            placeholder="Si lo dejas vacío se genera automático"
        >
    </div>

    {{-- Duración / Precio / Orden / Activo --}}
    <div class="col-md-3">
        <label class="form-label">Duración (minutos)</label>
        <input
            type="number"
            name="duration_minutes"
            class="form-control"
            value="{{ old('duration_minutes', $service->duration_minutes ?? '') }}"
        >
    </div>

    <div class="col-md-3">
        <label class="form-label">Precio base (€)</label>
        <input
            type="number"
            step="0.01"
            name="base_price"
            class="form-control"
            value="{{ old('base_price', $service->base_price ?? '') }}"
        >
    </div>

    <div class="col-md-3">
        <label class="form-label">Orden</label>
        <input
            type="number"
            name="sort_order"
            class="form-control"
            value="{{ old('sort_order', $service->sort_order ?? 0) }}"
        >
    </div>

    <div class="col-md-3 d-flex align-items-center">
        <div class="form-check mt-4">
            @php
                $isActive = old('is_active', $service->is_active ?? true);
            @endphp
            <input
                class="form-check-input"
                type="checkbox"
                name="is_active"
                id="is_active"
                {{ $isActive ? 'checked' : '' }}
            >
            <label class="form-check-label" for="is_active">
                Activo
            </label>
        </div>
    </div>

    {{-- Imagen del servicio --}}
    <div class="col-12">
        <label for="image" class="form-label">Imagen del servicio (opcional)</label>
        <input
            type="file"
            class="form-control @error('image') is-invalid @enderror"
            id="image"
            name="image"
            accept="image/jpeg,image/png,image/webp"
        >

        @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <small class="form-text text-muted d-block mb-2">
            Formatos: JPG, PNG o WEBP. Tamaño máximo: 2 MB.
        </small>

        @if(!empty($service->image))
            <div class="mt-1">
                <p class="form-text mb-1">Imagen actual:</p>
                <img
                    src="{{ asset('storage/'.$service->image) }}"
                    alt="Imagen actual del servicio"
                    class="img-thumbnail"
                    style="max-height: 160px;"
                >
            </div>
        @endif
    </div>

    {{-- Descripciones --}}
    <div class="col-12">
        <label class="form-label">Descripción corta</label>
        <input
            type="text"
            name="short_description"
            class="form-control"
            value="{{ old('short_description', $service->short_description ?? '') }}"
        >
    </div>

    <div class="col-12">
        <label class="form-label">Descripción larga</label>
        <textarea
            name="long_description"
            class="form-control"
            rows="4"
        >{{ old('long_description', $service->long_description ?? '') }}</textarea>
    </div>
</div>
