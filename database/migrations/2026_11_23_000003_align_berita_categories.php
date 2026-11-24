<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const LEGACY_CATEGORIES = ['Pembangunan', 'Sosial', 'Pemerintahan', 'Ekonomi', 'Lainnya'];

    public function up(): void
    {
        if (! Schema::hasTable('beritas') || ! Schema::hasTable('kategori_beritas')) {
            return;
        }

        $columns = Schema::getColumnListing('beritas');

        if (in_array('kategori', $columns, true)) {
            Schema::table('beritas', function (Blueprint $table): void {
                $table->enum('kategori', self::LEGACY_CATEGORIES)->nullable()->change();
            });
        }

        if (! in_array('kategori_berita_id', $columns, true)) {
            Schema::table('beritas', function (Blueprint $table): void {
                $table->foreignId('kategori_berita_id')
                    ->nullable()
                    ->constrained('kategori_beritas')
                    ->nullOnDelete();
            });
        }

        if (in_array('kategori', $columns, true)) {
            foreach (DB::table('beritas')->whereNotNull('kategori')->distinct()->pluck('kategori') as $namaKategori) {
                $kategoriId = DB::table('kategori_beritas')->where('nama', $namaKategori)->value('id');

                if (! $kategoriId) {
                    $kategoriId = DB::table('kategori_beritas')->insertGetId([
                        'nama' => $namaKategori,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                DB::table('beritas')
                    ->where('kategori', $namaKategori)
                    ->whereNull('kategori_berita_id')
                    ->update(['kategori_berita_id' => $kategoriId]);
            }
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('beritas')) {
            return;
        }

        $columns = Schema::getColumnListing('beritas');

        if (in_array('kategori', $columns, true)) {
            DB::table('beritas')->whereNull('kategori')->update(['kategori' => 'Lainnya']);

            Schema::table('beritas', function (Blueprint $table): void {
                $table->enum('kategori', self::LEGACY_CATEGORIES)->nullable(false)->change();
            });
        }

        if (in_array('kategori_berita_id', $columns, true)) {
            Schema::table('beritas', function (Blueprint $table): void {
                $table->dropForeign(['kategori_berita_id']);
                $table->dropColumn('kategori_berita_id');
            });
        }
    }
};
