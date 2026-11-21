<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sejarah extends Model
{
    protected $table = 'sejarahs';

    protected $fillable = [
        'hero_desc',
        'hero_img',
        'hero_caption',
        'asal_tag',
        'asal_title',
        'paragraf',
        'timeline_title',
        'timeline_sub',
        'timeline',
        'kepala_title',
        'kepala_sub',
        'kepala',
    ];

    protected $casts = [
        'paragraf' => 'array',
        'timeline' => 'array',
        'kepala'   => 'array',
    ];

    /**
     * Selalu ambil satu baris (singleton pattern).
     * Jika belum ada, buat dengan nilai default.
     */
    public static function instance(): static
    {
        return static::firstOrCreate(['id' => 1]);
    }

    /**
     * URL lengkap foto hero (untuk dipakai di Blade / preview).
     */
    public function getHeroImgUrlAttribute(): ?string
    {
        return $this->hero_img ? asset($this->hero_img) : null;
    }

    /**
     * URL foto tiap kepala sekolah sudah tersimpan di kolom foto_url
     * di dalam JSON. Method ini mengembalikan array kepala
     * dengan foto_url yang sudah dikonversi ke URL penuh.
     */
    public function getKepalaWithUrlAttribute(): array
    {
        return collect($this->kepala ?? [])->map(function ($item) {
            if (!empty($item['foto']) && !str_starts_with($item['foto'], 'http')) {
                $item['foto_url'] = asset($item['foto']);
            }
            return $item;
        })->toArray();
    }
}
