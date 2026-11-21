<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Statistic;

class StatisticSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // Kategori: Demografi (Counter Angka Atas)
            ['key' => 'total_penduduk', 'name' => 'Total Penduduk', 'value' => 3540, 'category' => 'demografi'],
            ['key' => 'kepala_keluarga', 'name' => 'Kepala Keluarga', 'value' => 890, 'category' => 'demografi'],
            ['key' => 'jumlah_dusun', 'name' => 'Jumlah Dusun', 'value' => 4, 'category' => 'demografi'],
            ['key' => 'luas_wilayah', 'name' => 'Hektar Wilayah', 'value' => 250, 'category' => 'demografi'],

            // Kategori: Bantuan Sosial
            ['key' => 'bantuan_blt', 'name' => 'BLT Dana Desa (KPM)', 'value' => 145, 'category' => 'bantuan'],
            ['key' => 'bantuan_pkh', 'name' => 'Program PKH (KPM)', 'value' => 86, 'category' => 'bantuan'],
            ['key' => 'bantuan_pangan', 'name' => 'Bantuan Pangan (KPM)', 'value' => 215, 'category' => 'bantuan'],

            // Kategori: Pendidikan (Chart Bar)
            ['key' => 'pend_sd', 'name' => 'SD', 'value' => 850, 'category' => 'pendidikan'],
            ['key' => 'pend_smp', 'name' => 'SMP', 'value' => 720, 'category' => 'pendidikan'],
            ['key' => 'pend_sma', 'name' => 'SMA', 'value' => 980, 'category' => 'pendidikan'],
            ['key' => 'pend_diploma', 'name' => 'Diploma', 'value' => 250, 'category' => 'pendidikan'],
            ['key' => 'pend_sarjana', 'name' => 'Sarjana', 'value' => 340, 'category' => 'pendidikan'],
            ['key' => 'pend_tidak_sekolah', 'name' => 'Tidak Sekolah', 'value' => 400, 'category' => 'pendidikan'],

            // Kategori: Pekerjaan (Chart Doughnut)
            ['key' => 'kerja_petani', 'name' => 'Petani', 'value' => 40, 'category' => 'pekerjaan'],
            ['key' => 'kerja_pns', 'name' => 'PNS/TNI', 'value' => 15, 'category' => 'pekerjaan'],
            ['key' => 'kerja_wiraswasta', 'name' => 'Wiraswasta', 'value' => 25, 'category' => 'pekerjaan'],
            ['key' => 'kerja_buruh', 'name' => 'Buruh', 'value' => 10, 'category' => 'pekerjaan'],
            ['key' => 'kerja_lainnya', 'name' => 'Lainnya', 'value' => 10, 'category' => 'pekerjaan'],

            // Kategori: Gender (Chart Pie)
            ['key' => 'gender_laki', 'name' => 'Laki-laki', 'value' => 1820, 'category' => 'gender'],
            ['key' => 'gender_perempuan', 'name' => 'Perempuan', 'value' => 1720, 'category' => 'gender'],
        ];

        foreach ($data as $item) {
            Statistic::create($item);
        }
    }
}
