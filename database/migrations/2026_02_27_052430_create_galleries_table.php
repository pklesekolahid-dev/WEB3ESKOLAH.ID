<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Judul singat (misal: "Pembangunan")
            $table->text('description')->nullable(); // Deskripsi saat foto dilebarkan
            $table->string('image')->nullable(); // Lokasi file foto
            $table->integer('position'); // Urutan foto (1 sampai 5)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('galleries');
    }
};