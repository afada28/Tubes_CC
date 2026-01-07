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
        Schema::create('info_donation', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('content');
            $table->string('payment_method_1');
            $table->string('payment_method_2')->nullable();
            $table->string('payment_method_3')->nullable();
            $table->string('pic_payment_method_1');
            $table->string('pic_payment_method_2')->nullable();
            $table->string('pic_payment_method_3')->nullable();
            $table->string('contact_person_1');
            $table->string('contact_person_2')->nullable();
            $table->string('contact_person_3')->nullable();
            $table->string('photo_1');
            $table->string('photo_2')->nullable();
            $table->string('photo_3')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_donation');
    }
};
