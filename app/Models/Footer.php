<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    protected $table = 'footers';

    protected $fillable = [
        'nama',
        'deskripsi',
        'copyright',
        'jam',
        'jam_catatan',
        'menu',
        'kontak',
    ];

    protected $casts = [
        'jam'    => 'array',
        'menu'   => 'array',
        'kontak' => 'array',
    ];

    public static function instance(): static
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
