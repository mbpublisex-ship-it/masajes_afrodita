<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Nombre *</label>
        <input type="text" name="name" class="form-control"
               value="{{ old('name', $masseuse->name ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Slug (opcional)</label>
        <input type="text" name="slug" class="form-control"
               value="{{ old('slug', $masseuse->slug ?? '') }}"
               placeholder="Si lo dejas vacío se genera automático">
    </div>

    <div class="col-md-3">
        <label class="form-label">Edad</label>
        <input type="number" name="age" class="form-control"
               value="{{ old('age', $masseuse->age ?? '') }}">
    </div>
    <div class="col-md-3">
        <label class="form-label">Nacionalidad</label>
        <input type="text" name="nationality" class="form-control"
               value="{{ old('nationality', $masseuse->nationality ?? '') }}">
    </div>
    <div class="col-md-3 d-flex align-items-center">
        <div class="form-check mt-4">
            @php
                // Por defecto: checked (true) cuando creas una nueva
                $isActive = old('is_active', $masseuse?->is_active ?? true);
            @endphp

            <input class="form-check-input" type="checkbox" name="is_active" id="is_active"
                {{ $isActive ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">
                Activa
            </label>
        </div>
    </div>

    <div class="col-12">
        <label class="form-label">Descripción corta</label>
        <textarea name="short_description" class="form-control" rows="2">{{ old('short_description', $masseuse->short_description ?? '') }}</textarea>
    </div>

    <div class="col-12">
        <label class="form-label">Descripción larga</label>
        <textarea name="long_description" class="form-control" rows="5">{{ old('long_description', $masseuse->long_description ?? '') }}</textarea>
    </div>

    <div class="col-md-6">
        <label class="form-label">Foto de portada</label>
        <input type="file" name="main_photo" class="form-control">
        @if(!empty($masseuse?->main_photo))
            <small class="d-block mt-1">Actualmente:</small>
            <img src="{{ asset('storage/'.$masseuse->main_photo) }}" class="mt-1 rounded" style="max-width:150px;">
        @endif
    </div>

    <div class="col-md-6">
        <label class="form-label">Galería (puedes seleccionar varias)</label>
        <input type="file" name="gallery[]" class="form-control" multiple>
    </div>
</div>
