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
        Schema::table('info_donation', function (Blueprint $table) {
            $table->string('status')->after('end_date'); // Sesuaikan posisi kolom sesuai kebutuhan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('info_donation', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
