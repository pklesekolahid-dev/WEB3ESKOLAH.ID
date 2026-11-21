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
        Schema::create('organisasi_sekolahs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jabatan'); // Kepala Sekolah, Sekertaris, dll
            $table->string('foto')->nullable();
            $table->string('nip')->nullable(); // Nomor Induk (Opsional)
            $table->integer('urutan')->default(99); // Agar bisa diurutkan manual
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organisasi_sekolahs');
    }
};
