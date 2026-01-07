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
        Schema::create('milestone', function (Blueprint $table) {
            $table->id();
            $table->string('timeline_title_1');
            $table->string('timeline_content_1');
            $table->string('timeline_title_2');
            $table->string('timeline_content_2');
            $table->string('timeline_title_3');
            $table->string('timeline_content_3');
            $table->string('timeline_title_4');
            $table->string('timeline_content_4');
            $table->string('photo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('milestone');
    }
};
