<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'              => ['required', 'string', 'max:255'],
            'slug'              => ['nullable', 'string', 'max:255', 'unique:services,slug'],
            'short_description' => ['nullable', 'string', 'max:255'],
            'long_description'  => ['nullable', 'string'],
            'duration_minutes'  => ['nullable', 'integer', 'min:10', 'max:600'],
            'base_price'        => ['nullable', 'numeric', 'min:0'],
            'sort_order'        => ['nullable', 'integer', 'min:0'],
            'image'             => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        // Slug automático si se deja vacío
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        // Activo o no
        $data['is_active'] = $request->has('is_active');

        // Subida de imagen (si la hay)
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('services', 'public');
        }

        Service::create($data);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Servicio creado correctamente.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'name'              => ['required', 'string', 'max:255'],
            'slug'              => ['nullable', 'string', 'max:255', 'unique:services,slug,' . $service->id],
            'short_description' => ['nullable', 'string', 'max:255'],
            'long_description'  => ['nullable', 'string'],
            'duration_minutes'  => ['nullable', 'integer', 'min:10', 'max:600'],
            'base_price'        => ['nullable', 'numeric', 'min:0'],
            'sort_order'        => ['nullable', 'integer', 'min:0'],
            'image'             => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        // Slug automático si se deja vacío
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        // Activo o no
        $data['is_active'] = $request->has('is_active');

        // Si sube nueva imagen, borramos la antigua y guardamos la nueva
        if ($request->hasFile('image')) {
            if ($service->image && Storage::disk('public')->exists($service->image)) {
                Storage::disk('public')->delete($service->image);
            }

            $data['image'] = $request->file('image')->store('services', 'public');
        }

        $service->update($data);

        return redirect()
            ->route('admin.services.edit', $service)
            ->with('success', 'Servicio actualizado.');
    }

    public function destroy(Service $service)
    {
        // Borrar imagen asociada si existe
        if ($service->image && Storage::disk('public')->exists($service->image)) {
            Storage::disk('public')->delete($service->image);
        }

        $service->delete();

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Servicio eliminado.');
    }
}
