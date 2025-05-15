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
        Schema::table('bookings', function (Blueprint $table) {
            // Ubah nama kolom name menjadi customer_name
            if (Schema::hasColumn('bookings', 'name')) {
                $table->renameColumn('name', 'name_customer');
            }

            // Ubah nama kolom phone menjadi phone_number
            if (Schema::hasColumn('bookings', 'phone')) {
                $table->renameColumn('phone', 'no_telepon');
            }

            // Ubah nama kolom start_date menjadi jadwal_mulai
            if (Schema::hasColumn('bookings', 'start_date')) {
                $table->renameColumn('start_date', 'waktu_mulai');
                $table->dateTime('waktu_mulai')->nullable()->change(); // Ubah tipe data menjadi DATETIME
            }

            // Ubah nama kolom end_date menjadi jadwal_selesai
            if (Schema::hasColumn('bookings', 'end_date')) {
                $table->renameColumn('end_date', 'waktu_selesai');
                $table->dateTime('waktu_selesai')->nullable()->change(); // Ubah tipe data menjadi DATETIME
            }





        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
