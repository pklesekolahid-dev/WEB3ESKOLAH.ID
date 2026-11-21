<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('layanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_layanan_id')->constrained('kategori_layanans')->onDelete('cascade');
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('deskripsi_singkat');
            $table->text('persyaratan');
            $table->string('biaya')->default('Gratis');
            $table->string('durasi')->nullable();
            $table->string('kontak_wa')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('layanans');
    }
};
