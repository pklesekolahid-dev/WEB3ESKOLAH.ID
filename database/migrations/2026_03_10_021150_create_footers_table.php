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
        Schema::create('footers', function (Blueprint $table) {
            $table->id();
            // Identitas
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->string('copyright')->nullable();

            // Jam pelayanan [{hari, waktu, tipe}]
            $table->json('jam')->nullable();
            $table->string('jam_catatan')->nullable();

            // Menu navigasi [{label, url}]
            $table->json('menu')->nullable();

            // Kontak [{tipe, nilai}]
            $table->json('kontak')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footers');
    }
};
