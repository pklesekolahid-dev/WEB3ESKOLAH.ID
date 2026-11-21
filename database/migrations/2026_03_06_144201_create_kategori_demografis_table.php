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
        Schema::create('kategori_demografis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_1');
            $table->string('nama_2');
            $table->string('nama_3');
            $table->string('nama_4');
            $table->string('icon_1');
            $table->string('icon_2');
            $table->string('icon_3');
            $table->string('icon_4');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_demografis');
    }
};
