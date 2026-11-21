<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profil_desas', function (Blueprint $table) {
            // Menambahkan kolom jam_pelayanan setelah kolom telepon
            $table->text('jam_pelayanan')->nullable()->after('telepon');
        });
    }

    public function down(): void
    {
        Schema::table('profil_desas', function (Blueprint $table) {
            $table->dropColumn('jam_pelayanan');
        });
    }
};