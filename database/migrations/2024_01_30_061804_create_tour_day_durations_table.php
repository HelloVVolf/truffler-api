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
        Schema::create('tour_day_durations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('place_id');
            $table->unsignedBigInteger('tour_day_id');

            $table->foreign('place_id')->references('id')->on('places')->onDelete('cascade');
            $table->foreign('tour_day_id')->references('id')->on('tour_days')->onDelete('cascade');

            $table->smallInteger('order');
            $table->bigInteger('duration');
            $table->boolean('optional')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_day_durations');
    }
};
