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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->integer('stock');


            $table->foreignId('pilihpakets_id')->nullable()->constrained('pilihpakets');

            $table->text('photos')->nullable();

            $table->integer('rating')->default(0);

            $table->text('deksripsi')->nullable();
            $table->integer('jumlah_penumpang')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
