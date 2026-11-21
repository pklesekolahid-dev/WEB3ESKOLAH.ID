<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Navbar extends Model
{
    protected $table = 'navbars';

    protected $fillable = [
        'menu_utama',
        'dropdown_label',
        'dropdown_items',
    ];

    protected $casts = [
        'menu_utama'      => 'array',
        'dropdown_items'  => 'array',
    ];

    public static function instance(): static
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
