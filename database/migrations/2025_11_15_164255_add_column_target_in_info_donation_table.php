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
            if (!Schema::hasColumn('info_donation', 'target')) {
                $table->string('target')->after('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('info_donation', function (Blueprint $table) {
            $table->string('target')->after('status'); // Sesuaikan posisi kolom sesuai kebutuhan
        });
    }
};
