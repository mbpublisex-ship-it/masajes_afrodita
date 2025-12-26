<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\MasseuseController as AdminMasseuseController;
use App\Http\Controllers\MasseuseController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\ServiceController;


// Rutas públicas (home y masajistas públicas)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/masajistas', [MasseuseController::class, 'index'])->name('masseuses.index');
Route::get('/masajistas/{slug}', [MasseuseController::class, 'show'])->name('masseuses.show');

//Route::get('/servicios', [ServiceController::class, 'index'])->name('services.index');
Route::get('/carta-de-masajes', [ServiceController::class, 'index'])->name('services.index');
Route::view('/instalaciones', 'installations.index')->name('installations.index');
Route::view('/empleo', 'jobs')->name('jobs');



Route::get('/servicios/{slug}', [ServiceController::class, 'show'])->name('services.show');

// Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin
Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', function () {
            return redirect()->route('admin.masseuses.index');
        })->name('dashboard');

        Route::resource('masseuses', AdminMasseuseController::class)->parameters([
            'masseuses' => 'masseuse',
        ]);

        // 👇 NUEVA ruta para borrar una foto concreta de una masajista
        Route::delete('masseuses/{masseuse}/photos/{photo}', [AdminMasseuseController::class, 'destroyPhoto'])
            ->name('masseuses.photos.destroy');

        // 👉 CRUD de servicios
        Route::resource('services', AdminServiceController::class)->parameters([
            'services' => 'service',
        ]);
    });
