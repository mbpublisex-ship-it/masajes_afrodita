<?php

namespace App\Http\Controllers;

use App\Models\Masseuse;
use Illuminate\Http\Request;

class MasseuseController extends Controller
{
    // Listado
    public function index()
    {
        $masseuses = Masseuse::where('is_active', true)
            ->orderBy('name')
            ->paginate(12);

        return view('masseuses.index', compact('masseuses'));
    }


    // Ficha
    public function show(string $slug)
    {
        $masseuse = Masseuse::where('slug', $slug)
            ->where('is_active', true)
            ->with('photos')
            ->firstOrFail();

        return view('masseuses.show', compact('masseuse'));
    }
}
