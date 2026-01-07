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
        Schema::create('donation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('info_donation_id');
            $table->string('name');
            $table->string('donate')->nullable();
            $table->string('address')->nullable();
            $table->string('phonenumber')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();

            $table->foreign('info_donation_id')
                  ->references('id')
                  ->on('info_donation')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donation');
    }
};
