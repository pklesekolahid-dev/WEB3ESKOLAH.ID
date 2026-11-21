<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiUmum extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_sekolah',
        'kecamatan',
        'kabupaten',
        'kode_pos',
        'slogan',
        'logo',
        'foto_identitas',
        'nama_fasilitas_1',
        'nama_fasilitas_2',
        'nama_fasilitas_3',
        'nama_fasilitas_4',
        'jumlah_sekolah',
        'jumlah_ibadah',
        'jumlah_puskesmas',
        'jumlah_balai',
        'foto_fasilitas',
        'kontak_wa',
        'kontak_email',
    ];
}
