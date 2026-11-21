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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('gambar'); // Untuk menyimpan nama file foto
            $table->string('judul')->nullable(); // Teks besar (opsional, bisa dikosongkan)
            $table->text('deskripsi')->nullable(); // Teks kecil (opsional)
            $table->boolean('is_active')->default(true); // Status tampil/sembunyi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
