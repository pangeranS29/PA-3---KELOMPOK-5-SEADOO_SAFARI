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
        Schema::table('users', function (Blueprint $table) {
            $table->text('two_factor_secret')->after('roles')->nullable(); // Kolom two_factor_secret, nullable
            $table->text('two_factor_recovery_codes')->after('two_factor_secret')->nullable(); // Kolom two_factor_recovery_codes, nullable
            $table->timestamp('two_factor_confirmed_at')->after('two_factor_recovery_codes')->nullable(); // Kolom two_factor_confi
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('two_factor_secret'); // Hapus kolom two_factor_secret
            $table->dropColumn('two_factor_recovery_codes'); // Hapus kolom two_factor_recovery_codes
            $table->dropColumn('two_factor_confirmed_at'); // Hapus kolom two_factor_confirmed_at
        });
    }
};
