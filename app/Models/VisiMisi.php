<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisiMisi extends Model
{
    protected $table = 'visi_misis';

    protected $fillable = ['visi', 'visi_subtitle', 'header_subtitle', 'misi', 'nilai'];

    protected $casts = [
        'misi'  => 'array',
        'nilai' => 'array',
    ];

    public function getMisiAttribute($value)
    {
        $decoded = json_decode($value, true);
        // Handle double-encoded
        if (is_string($decoded)) {
            $decoded = json_decode($decoded, true);
        }
        return $decoded ?? [];
    }

    public function getNilaiAttribute($value)
    {
        $decoded = json_decode($value, true);
        if (is_string($decoded)) {
            $decoded = json_decode($decoded, true);
        }
        return $decoded ?? [];
    }
}
