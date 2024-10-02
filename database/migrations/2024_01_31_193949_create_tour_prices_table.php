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
        Schema::create('tour_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tour_id');
            $table->foreign('tour_id')->references('id')->on('tours')->onDelete('cascade');

            $table->string('name');
            $table->text('details');
            $table->smallInteger('max_participant')->default(0);
            $table->bigInteger('initial_price')->default(0);
            $table->bigInteger('adult_price')->nullable();
            $table->bigInteger('child_price')->nullable();
            $table->bigInteger('infant_price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_prices');
    }
};
