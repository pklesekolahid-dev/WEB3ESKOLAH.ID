<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Geografis extends Model
{
    protected $table = 'geografis';

    protected $fillable = [
        'hero_desc',
        'maps_embed_url',
        'maps_caption',
        'letak_desc',
        'batas',
        'topografi_title',
        'topografi',
    ];

    protected $casts = [
        'batas'     => 'array',
        'topografi' => 'array',
    ];

    public static function instance(): static
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
