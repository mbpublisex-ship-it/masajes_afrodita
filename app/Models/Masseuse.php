<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Masseuse extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'age',
        'nationality',
        'main_photo',
        'short_description',
        'long_description',
        'is_active',
    ];

    public function photos()
    {
        return $this->hasMany(MasseusePhoto::class)->orderBy('sort_order');
    }

    // Ya no necesitamos alias, así que el displayName es simplemente name
    public function displayName(): string
    {
        return $this->name;
    }
}
