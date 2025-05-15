<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('paket_jetski', function (Blueprint $table) {
            // Ubah kolom 'stok' menjadi 'jumlah_jetski' dengan batasan CHECK
            $table->renameColumn('stok', 'jumlah_jetski');

            // Modifikasi kolom jumlah_jetski agar memiliki check constraint
            $table->integer('jumlah_jetski')
                ->check('jumlah_jetski >= 0 AND jumlah_jetski <= 100')
                ->nullable()
                ->change();
        });
    }

    public function down(): void
    {
        Schema::table('paket_jetski', function (Blueprint $table) {
            // Kembalikan ke nama awal jika rollback
            $table->renameColumn('jumlah_jetski', 'stok');
        });
    }
};
