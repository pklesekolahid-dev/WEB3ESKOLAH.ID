<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('informasi_umums', function (Blueprint $table) {
            $table->id();
            // Identitas Desa
            $table->string('nama_desa');
            $table->string('kecamatan');
            $table->string('kabupaten');
            $table->string('kode_pos');
            $table->string('foto_identitas')->nullable(); // Foto samping kanan atas
            
            // Fasilitas Desa
            $table->integer('jumlah_sekolah')->default(0);
            $table->integer('jumlah_ibadah')->default(0);
            $table->integer('jumlah_puskesmas')->default(0);
            $table->integer('jumlah_balai')->default(0);
            $table->string('foto_fasilitas')->nullable(); // Foto samping kanan bawah
            
            // Kontak
            $table->string('kontak_wa');
            $table->string('kontak_email');
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('informasi_umums');
    }
};
