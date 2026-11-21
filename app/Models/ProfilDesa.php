<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilDesa extends Model
{
    use HasFactory;

    // Arahkan ke tabel milik Mas
    protected $table = 'profil_desas';

    // Daftarkan semua kolom yang ada di tabel Mas + jam pelayanan
    protected $fillable = [
        'nama_desa',
        'alamat',
        'email',
        'telepon',
        'jam_pelayanan',
        'deskripsi_singkat',
        'sejarah',
        'visi',
        'misi',
        'iframe_google_maps',
    ];
}