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
    Schema::create('profil_desas', function (Blueprint $table) {
        $table->id();
        $table->string('nama_desa')->default('Desa Digital');
        $table->text('alamat');
        $table->string('email')->nullable();
        $table->string('telepon')->nullable();
        $table->text('deskripsi_singkat')->nullable(); // Untuk footer/hero
        $table->text('sejarah')->nullable();
        $table->text('visi')->nullable();
        $table->text('misi')->nullable(); // Bisa disimpan sebagai JSON atau List Text
        $table->text('iframe_google_maps')->nullable(); // Link embed maps
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_desas');
    }
};
