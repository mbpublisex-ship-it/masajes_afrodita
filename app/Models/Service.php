<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'long_description',
        'duration_minutes',
        'base_price',
        'is_active',
        'sort_order',
        'image',
    ];
}
