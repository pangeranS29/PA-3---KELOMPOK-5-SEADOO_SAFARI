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
        // Periksa apakah tabel 'pilihpakets' sudah ada
        if (Schema::hasTable('pilihpakets')) {
            Schema::table('pilihpakets', function (Blueprint $table) {
                // Ubah nama kolom 'title' menjadi 'judul'
                if (Schema::hasColumn('pilihpakets', 'title')) {
                    $table->renameColumn('title', 'judul');
                }

                if (Schema::hasColumn('pilihpakets', 'price')) {
                    $table->renameColumn('price', 'harga');
                }

                

                if (!Schema::hasColumn('pilihpakets', 'stok')) {
                    $table->integer('stok')->default(0)->after('deskripsi'); // Stok total paket
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan perubahan jika rollback
        if (Schema::hasTable('pilihpakets')) {
            Schema::table('pilihpakets', function (Blueprint $table) {
                // Kembalikan nama kolom 'judul' menjadi 'title'
                if (Schema::hasColumn('pilihpakets', 'judul')) {
                    $table->renameColumn('judul', 'title');
                }

                // Hapus kolom tambahan jika ditambahkan
                if (Schema::hasColumn('pilihpakets', 'harga')) {
                    $table->dropColumn('harga');
                }
                if (Schema::hasColumn('pilihpakets', 'deskripsi')) {
                    $table->dropColumn('deskripsi');
                }
                if (Schema::hasColumn('pilihpakets', 'stok')) {
                    $table->dropColumn('stok');
                }
            });
        }
    }
};
