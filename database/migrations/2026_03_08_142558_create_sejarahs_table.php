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
        Schema::create('sejarahs', function (Blueprint $table) {
            $table->id();
            // ── Hero / Banner
            $table->text('hero_desc')->nullable();
            $table->string('hero_img')->nullable()->comment('Path file foto utama');
            $table->string('hero_caption')->nullable();

            // ── Latar Belakang & Pendirian
            $table->string('asal_tag')->default('Sejarah & Pendirian');
            $table->string('asal_title')->nullable();
            $table->json('paragraf')->nullable()->comment('Array string paragraf isi');

            // ── Timeline
            $table->string('timeline_title')->default('Jejak Langkah Sekolah');
            $table->string('timeline_sub')->nullable();
            $table->json('timeline')->nullable()->comment('Array [{tahun, judul, deskripsi}]');

            // ── Kepala Sekolah
            $table->string('kepala_title')->default('Pimpinan Sekolah dari Masa ke Masa');
            $table->string('kepala_sub')->nullable();
            $table->json('kepala')->nullable()->comment('Array [{nama, periode, foto_url, aktif}]');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sejarahs');
    }
};
