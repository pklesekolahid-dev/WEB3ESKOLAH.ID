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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_usaha');
            $table->string('pemilik');
            $table->string('no_wa'); // Format 628xxx
            $table->foreignId('kategori_produk_id')->constrained('kategori_produks')->onDelete('cascade');
            $table->integer('harga_mulai')->nullable(); // Harga terendah (opsional)
            $table->text('deskripsi');
            $table->string('foto')->nullable();
            $table->enum('status', ['pending', 'disetujui', 'ditolak'])->default('pending'); // Fitur Hybrid
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkms');
    }
};
