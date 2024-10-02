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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('type_id');
            $table->string('type_type');
            $table->foreignId('user_id')->nullable();
            $table->string('session')->nullable();

            $table->string('slug')->unique();
            $table->string('name')->nullable();
            $table->string('email')->nullable();

            $table->string('status')->default('pending');
            $table->integer('value')->default(5);
            $table->string('title');
            $table->text('text');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
