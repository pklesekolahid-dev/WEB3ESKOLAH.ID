<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InformasiUmum;

class InformasiUmumSeeder extends Seeder
{
    public function run()
    {
        InformasiUmum::create([
            'nama_sekolah' => 'Sekolah Sukarejo',
            'kecamatan' => 'Kecamatan Digital',
            'kabupaten' => 'Kabupaten Maju',
            'kode_pos' => '65432',
            'slogan' => 'Belajar dan tumbuh bersama',
            'nama_fasilitas_1' => 'Sekolah Dasar',
            'nama_fasilitas_2' => 'Tempat Ibadah',
            'nama_fasilitas_3' => 'Puskesmas / Pustu',
            'nama_fasilitas_4' => 'Balai Warga',
            'jumlah_sekolah' => 4,
            'jumlah_ibadah' => 8,
            'jumlah_puskesmas' => 1,
            'jumlah_balai' => 3,
            'kontak_wa' => '083133387676',
            'kontak_email' => 'halo@sukarejo.desa.id'
        ]);
    }
}
