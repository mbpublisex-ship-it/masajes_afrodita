<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Masseuse;
use App\Models\MasseusePhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;



class MasseuseController extends Controller
{
    public function index()
    {
        $masseuses = Masseuse::where('is_active', true)
            ->orderBy('name')
            ->paginate(12);

        return view('admin.masseuses.index', compact('masseuses'));
    }

    public function create()
    {
        return view('admin.masseuses.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'              => ['required', 'string', 'max:255'],
            'slug'              => ['nullable', 'string', 'max:255', 'unique:masseuses,slug'],
            'age'               => ['nullable', 'integer', 'min:18', 'max:80'],
            'nationality'       => ['nullable', 'string', 'max:255'],
            'short_description' => ['nullable', 'string'],
            'long_description'  => ['nullable', 'string'],
            // ⚠️ is_active fuera de las reglas
            'main_photo'        => ['nullable', 'image', 'max:4096'],
            'gallery.*'         => ['nullable', 'image', 'max:4096'],
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        // ✅ checkbox: si viene marcado, true, si no, false
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('main_photo')) {
            $data['main_photo'] = $request->file('main_photo')
                ->store('masseuses/covers', 'public');
        }

        $masseuse = Masseuse::create($data);

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $index => $file) {
                $path = $file->store('masseuses/gallery', 'public');

                MasseusePhoto::create([
                    'masseuse_id' => $masseuse->id,
                    'path'        => $path,
                    'sort_order'  => $index,
                ]);
            }
        }

        return redirect()->route('admin.masseuses.index')
            ->with('success', 'Masajista creada correctamente.');
    }

    public function edit(Masseuse $masseuse)
    {
        $masseuse->load('photos');

        return view('admin.masseuses.edit', compact('masseuse'));
    }

    public function update(Request $request, Masseuse $masseuse)
    {
        $data = $request->validate([
            'name'              => ['required', 'string', 'max:255'],
            'slug'              => ['nullable', 'string', 'max:255', 'unique:masseuses,slug,' . $masseuse->id],
            'age'               => ['nullable', 'integer', 'min:18', 'max:80'],
            'nationality'       => ['nullable', 'string', 'max:255'],
            'short_description' => ['nullable', 'string'],
            'long_description'  => ['nullable', 'string'],
            // ⚠️ is_active fuera de las reglas
            'main_photo'        => ['nullable', 'image', 'max:4096'],
            'gallery.*'         => ['nullable', 'image', 'max:4096'],
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        // ✅ checkbox: marcado = true, sin marcar = false
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('main_photo')) {
            if ($masseuse->main_photo) {
                Storage::disk('public')->delete($masseuse->main_photo);
            }

            $data['main_photo'] = $request->file('main_photo')
                ->store('masseuses/covers', 'public');
        }

        $masseuse->update($data);

        if ($request->hasFile('gallery')) {
            $currentCount = $masseuse->photos()->count();

            foreach ($request->file('gallery') as $index => $file) {
                $path = $file->store('masseuses/gallery', 'public');

                MasseusePhoto::create([
                    'masseuse_id' => $masseuse->id,
                    'path'        => $path,
                    'sort_order'  => $currentCount + $index,
                ]);
            }
        }

        return redirect()->route('admin.masseuses.edit', $masseuse)
            ->with('success', 'Masajista actualizada correctamente.');
    }

    public function destroy(Masseuse $masseuse)
    {
        foreach ($masseuse->photos as $photo) {
            Storage::disk('public')->delete($photo->path);
        }

        if ($masseuse->main_photo) {
            Storage::disk('public')->delete($masseuse->main_photo);
        }

        $masseuse->delete();

        return redirect()->route('admin.masseuses.index')
            ->with('success', 'Masajista eliminada.');
    }

    public function destroyPhoto(Masseuse $masseuse, MasseusePhoto $photo)
    {
        // Seguridad: que la foto pertenezca realmente a esa masajista
        if ($photo->masseuse_id !== $masseuse->id) {
            abort(404);
        }

        // Borramos el fichero físico
        Storage::disk('public')->delete($photo->path);

        // Borramos el registro en BD
        $photo->delete();

        return redirect()
            ->route('admin.masseuses.edit', $masseuse)
            ->with('success', 'Foto eliminada correctamente.');
    }
}
