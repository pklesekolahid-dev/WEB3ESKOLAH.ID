<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks'; // Pastikan nama tabel benar

    protected $fillable = [
        'nama_usaha',
        'pemilik',
        'no_wa',
        'kategori_produk_id',
        'harga_mulai',
        'deskripsi',
        'foto',      // Ingat: Di database Mas namanya 'foto', bukan 'gambar'
        'status',    // pending, disetujui, ditolak
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriProduk::class, 'kategori_produk_id');
    }
}
