<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    // Pastikan nama tabelnya pas
    protected $table = 'pengumuman';

    // Kolom yang boleh diisi
    protected $fillable = [
        'teks',
        'is_active',
    ];
}