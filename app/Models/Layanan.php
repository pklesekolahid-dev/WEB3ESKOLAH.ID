<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Layanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_layanan_id',
        'judul',
        'slug',
        'deskripsi_singkat',
        'persyaratan',
        'biaya',
        'durasi',
        'kontak_wa',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($layanan) {
            $layanan->slug = Str::slug($layanan->judul);
        });

        static::updating(function ($layanan) {
            $layanan->slug = Str::slug($layanan->judul);
        });
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriLayanan::class, 'kategori_layanan_id');
    }
}
