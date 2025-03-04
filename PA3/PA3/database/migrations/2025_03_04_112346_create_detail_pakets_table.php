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
        Schema::create('detail_paket', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('pilihpakets_id')->nullable()->constrained('pilihpakets'); // Foreign key ke pilihpakets
            $table->text('foto')->nullable(); // Foto detail paket
            $table->float('rating')->default(0); // Rating detail paket
            $table->text('deskripsi')->nullable(); // Deskripsi detail paket
            $table->integer('jumlah_penumpang')->nullable(); // Jumlah penumpang
            $table->softDeletes(); // Soft deletes
            $table->timestamps(); // Timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_paket');
    }
};
