<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gallery;

class GallerySeeder extends Seeder
{
    public function run()
    {
        $galleries = [
            ['position' => 1, 'title' => 'Lensa Desa', 'description' => 'Potret kegiatan utama dan pusat pemerintahan Desa Sukarejo.', 'image' => null],
            ['position' => 2, 'title' => 'Infrastruktur', 'description' => 'Perkembangan pembangunan fasilitas umum dan jalan desa.', 'image' => null],
            ['position' => 3, 'title' => 'Gotong Royong', 'description' => 'Semangat kebersamaan warga dalam membangun desa.', 'image' => null],
            ['position' => 4, 'title' => 'Potensi Alam', 'description' => 'Keindahan dan kekayaan sumber daya alam yang kita miliki.', 'image' => null],
            ['position' => 5, 'title' => 'Budaya & Tradisi', 'description' => 'Melestarikan warisan leluhur dan kegiatan kebudayaan warga.', 'image' => null],
        ];

        foreach ($galleries as $gallery) {
            Gallery::create($gallery);
        }
    }
}