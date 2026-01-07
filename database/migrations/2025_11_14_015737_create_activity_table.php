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
        Schema::create('activity', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('content');
            $table->string('location');
            $table->date('date');
            $table->string('time');
            $table->string('photo_1');
            $table->string('photo_2')->nullable();
            $table->string('photo_3')->nullable();
            $table->string('photo_4')->nullable();
            $table->string('photo_5')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity');
    }
};
