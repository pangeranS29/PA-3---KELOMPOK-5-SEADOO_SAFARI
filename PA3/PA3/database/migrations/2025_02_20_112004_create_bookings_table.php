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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->string('phone')->nullable();

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();


            // Status
            $table->string('status')->default('pending');

            // Payment
            $table->string('payment_method')->default('midtrans');
            $table->string('payment_status')->default('pending');
            $table->string('payment_url')->nullable();

            // Total Price
            $table->foreignId('pilihpakets_id')->nullable()->constrained('pilihpakets');
            $table->integer('total_price')->default(0);

            // Relation to Item And User
            $table->foreignId('items_id')->constrained();
            $table->foreignId('users_id')->constrained();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'name', 'phone', 'start_date', 'end_date', 'status', 'payment_method',
                'payment_status', 'payment_url', 'pilihpakets_id', 'total_price', 'items_id', 'users_id'
            ]);
        });
    }
};
