<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('statistics', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // Kode unik (misal: total_penduduk)
            $table->string('name'); // Nama label (misal: Total Penduduk)
            $table->integer('value')->default(0); // Angkanya (misal: 3540)
            $table->string('category'); // Kategori (misal: demografi, bantuan, pendidikan)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('statistics');
    }
};
