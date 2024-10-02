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
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_category_id')->nullable();
            $table->string('slug')->unique();
            $table->string('name');
            $table->text('about')->nullable();
            $table->text('benefit')->nullable();
            $table->text('info')->nullable();
            $table->text('acessibility')->nullable();
            $table->time('time_min')->default("00:00:00");
            $table->time('time_max')->default("00:00:00");
            $table->smallInteger('age_min')->default(0);
            $table->smallInteger('age_max')->default(99);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
