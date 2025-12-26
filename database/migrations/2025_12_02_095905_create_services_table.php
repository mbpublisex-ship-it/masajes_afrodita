<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');                 // Nombre del masaje
            $table->string('slug')->unique();       // /servicios/masaje-relajante
            $table->string('short_description')->nullable(); // frase corta
            $table->text('long_description')->nullable();    // descripción completa
            $table->unsignedSmallInteger('duration_minutes')->nullable(); // 60, 90...
            $table->decimal('base_price', 8, 2)->nullable(); // precio base
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0); // orden en la lista
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
