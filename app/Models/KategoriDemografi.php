<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriDemografi extends Model
{
    protected $table = 'kategori_demografis';

    protected $fillable = [
        'nama_1',
        'nama_2',
        'nama_3',
        'nama_4',
        'icon_1',
        'icon_2',
        'icon_3',
        'icon_4',
    ];
}
