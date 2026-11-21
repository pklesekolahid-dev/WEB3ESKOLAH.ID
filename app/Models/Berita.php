<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    // Tambahkan baris ini untuk mengizinkan kolom-kolom berikut diisi data
    protected $fillable = [
        'judul',
        'slug',
        'konten',
        'gambar',
        'kategori_berita_id',
        'penulis',
        'views'
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriBerita::class, 'kategori_berita_id');
    }
}
