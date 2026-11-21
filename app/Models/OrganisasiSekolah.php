<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganisasiSekolah extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'jabatan',
        'tipe',
        'nip',
        'foto',
        'urutan',
    ];
}
