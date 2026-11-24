<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('informasi_umums')) {
            return;
        }

        $columns = Schema::getColumnListing('informasi_umums');

        if (in_array('nama_desa', $columns, true) && ! in_array('nama_sekolah', $columns, true)) {
            Schema::table('informasi_umums', function (Blueprint $table): void {
                $table->renameColumn('nama_desa', 'nama_sekolah');
            });
        }

        $columns = Schema::getColumnListing('informasi_umums');

        Schema::table('informasi_umums', function (Blueprint $table) use ($columns): void {
            if (! in_array('slogan', $columns, true)) {
                $table->text('slogan')->nullable();
            }

            if (! in_array('logo', $columns, true)) {
                $table->string('logo')->nullable();
            }

            foreach (range(1, 4) as $number) {
                $column = 'nama_fasilitas_'.$number;

                if (! in_array($column, $columns, true)) {
                    $table->string($column)->nullable();
                }
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('informasi_umums')) {
            return;
        }

        $columns = Schema::getColumnListing('informasi_umums');
        $addedColumns = array_values(array_filter(
            ['slogan', 'logo', 'nama_fasilitas_1', 'nama_fasilitas_2', 'nama_fasilitas_3', 'nama_fasilitas_4'],
            fn (string $column): bool => in_array($column, $columns, true),
        ));

        if ($addedColumns !== []) {
            Schema::table('informasi_umums', function (Blueprint $table) use ($addedColumns): void {
                $table->dropColumn($addedColumns);
            });
        }

        $columns = Schema::getColumnListing('informasi_umums');

        if (in_array('nama_sekolah', $columns, true) && ! in_array('nama_desa', $columns, true)) {
            Schema::table('informasi_umums', function (Blueprint $table): void {
                $table->renameColumn('nama_sekolah', 'nama_desa');
            });
        }
    }
};
