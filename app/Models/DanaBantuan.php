<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DanaBantuan extends Model
{
    protected $table = 'dana_bantuans';

    protected $fillable = [
        'judul',
        'url',
        'gambar'
    ];
}
