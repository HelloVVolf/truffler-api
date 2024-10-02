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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_role_id')->default(3);
            $table->foreignId('user_status_id')->default(1);

            $table->string('slug')->unique();
            $table->string('username')->nullable()->max(16)->unique();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();

            $table->string('phone')->nullable()->unique();
            $table->string('country')->nullable();
            $table->string('image')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->foreignId('gender')->default(null)->nullable();
            $table->boolean('newsletter_subscription')->default(false);

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
