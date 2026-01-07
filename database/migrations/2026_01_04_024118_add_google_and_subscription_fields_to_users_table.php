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
            $table->string('google_id')->nullable()->unique()->after('email');
            $table->string('avatar')->nullable()->after('google_id');
            $table->boolean('is_admin')->default(false)->after('avatar');
            $table->boolean('is_subscribed')->default(false)->after('is_admin');
            $table->timestamp('subscribed_at')->nullable()->after('is_subscribed');
            $table->timestamp('subscription_ends_at')->nullable()->after('subscribed_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['google_id', 'avatar', 'is_admin', 'is_subscribed', 'subscribed_at', 'subscription_ends_at']);
        });
    }
};
