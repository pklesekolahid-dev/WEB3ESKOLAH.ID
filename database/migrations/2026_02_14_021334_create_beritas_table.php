<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::create('beritas', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->string('slug')->unique(); // URL ramah SEO: judul-berita-ini
        $table->text('konten'); // Isi lengkap
        $table->string('gambar')->nullable();
        $table->enum('kategori', ['Pembangunan', 'Sosial', 'Pemerintahan', 'Ekonomi', 'Lainnya']);
        $table->string('penulis')->default('Admin');
        $table->integer('views')->default(0); // Hitung jumlah pembaca
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};
