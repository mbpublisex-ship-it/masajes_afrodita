<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('masseuse_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('masseuse_id')->constrained()->onDelete('cascade');
            $table->string('path'); // ruta en storage, ej: "masseuses/sofia/1.jpg"
            $table->boolean('is_visible')->default(true);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('masseuse_photos');
    }
};
