<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MasseusePhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'masseuse_id',
        'path',
        'is_visible',
        'sort_order',
    ];

    public function masseuse()
    {
        return $this->belongsTo(Masseuse::class);
    }
}
