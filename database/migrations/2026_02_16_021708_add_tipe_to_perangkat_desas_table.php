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
        // This legacy table may not exist in fresh installations.
        if (Schema::hasTable('perangkat_desas') && !Schema::hasColumn('perangkat_desas', 'tipe')) {
            Schema::table('perangkat_desas', function (Blueprint $table) {
            // Menambahkan kolom tipe setelah kolom jabatan
            // Default 'Staf Inti' agar data lama tidak error
                $table->enum('tipe', ['Staf Inti', 'Guru/Walikelas'])->default('Staf Inti')->after('jabatan');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('perangkat_desas') && Schema::hasColumn('perangkat_desas', 'tipe')) {
            Schema::table('perangkat_desas', function (Blueprint $table) {
                $table->dropColumn('tipe');
            });
        }
    }
};
