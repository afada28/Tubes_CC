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
        Schema::create('section_carousel', function (Blueprint $table) {
            $table->id();
            $table->string('title_1');
            $table->string('content_1');
            $table->string('photo_1');
            $table->string('title_2');
            $table->string('content_2');
            $table->string('photo_2');
            $table->string('title_3');
            $table->string('content_3');
            $table->string('photo_3');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section_carousel');
    }
};
