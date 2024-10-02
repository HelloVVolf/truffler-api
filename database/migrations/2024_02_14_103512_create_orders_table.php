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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('slug')->unique();

            $table->string('type_type');
            $table->foreignId('type_id');
            $table->foreignId('user_id')->nullable();
            $table->string('session')->nullable();

            $table->float('total_price')->default(0);
            $table->json('details')->nullable();

            $table->string('status')->default('requested');
            $table->datetime('start_date');
            $table->datetime('end_date')->nullable();

            $table->string('location')->nullable();
            $table->string('address')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
