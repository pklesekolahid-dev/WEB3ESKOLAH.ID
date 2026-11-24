<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('organisasi_sekolahs') && !Schema::hasColumn('organisasi_sekolahs', 'tipe')) {
            Schema::table('organisasi_sekolahs', function (Blueprint $table) {
                $table->string('tipe')->default('Staf Inti');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('organisasi_sekolahs') && Schema::hasColumn('organisasi_sekolahs', 'tipe')) {
            Schema::table('organisasi_sekolahs', function (Blueprint $table) {
                $table->dropColumn('tipe');
            });
        }
    }
};
