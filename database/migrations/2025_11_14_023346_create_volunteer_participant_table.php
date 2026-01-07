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
        Schema::create('volunteer_participant', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('volunteer_id');
            $table->string('name');
            $table->string('adress');
            $table->string('phonenumber');
            $table->string('email');
            $table->string('reason');
            $table->string('experience');
            $table->string('last_education');
            $table->string('file_1');
            $table->string('file_2')->nullable();
            $table->string('file_3')->nullable();
            $table->timestamps();

            $table->foreign('volunteer_id')
            ->references('id')
            ->on('volunteer')
            ->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteer_participant');
    }
};
