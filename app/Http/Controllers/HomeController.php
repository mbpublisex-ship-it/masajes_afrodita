<?php

namespace App\Http\Controllers;

use App\Models\Masseuse;
use App\Models\Service;

class HomeController extends Controller
{
    public function index()
    {
        $masseuses = Masseuse::where('is_active', true)
            ->orderBy('name')
            ->take(6)
            ->get();

        $services = Service::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->take(6)
            ->get();

        return view('home', compact('masseuses', 'services'));
    }
}
