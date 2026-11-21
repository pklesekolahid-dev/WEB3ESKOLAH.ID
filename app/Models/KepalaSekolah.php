<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KepalaSekolah extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nip',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'foto',
        'pendidikan',
        'organisasi',
        'visi_misi',
    ];

    // Casting tanggal agar otomatis jadi objek Carbon (mudah diformat)
    protected $casts = [
        'tanggal_lahir' => 'date',
    ];
}
