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
        Schema::create('volunteer', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('content');
            $table->string('date');
            $table->string('specification_1');
            $table->string('specification_2')->nullable();
            $table->string('specification_3')->nullable();
            $table->string('specification_4')->nullable();
            $table->string('specification_5')->nullable();
            $table->string('specification_6')->nullable();
            $table->string('specification_7')->nullable();
            $table->string('specification_8')->nullable();
            $table->string('specification_9')->nullable();
            $table->string('specification_10')->nullable();
            $table->string('photo_1');
            $table->string('photo_2')->nullable();
            $table->string('photo_3')->nullable();
            $table->string('pic_1');
            $table->string('pic_2')->nullable();
            $table->string('phonenumber_1');
            $table->string('phonenumber_2')->nullable();
            $table->string('link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteer');
    }
};
