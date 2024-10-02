<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tour_tag', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tour_id');
            $table->unsignedBigInteger('tour_tag_id');
            $table->timestamps();

            $table->foreign('tour_id')->references('id')->on('tours')->onDelete('cascade');
            $table->foreign('tour_tag_id')->references('id')->on('tour_tags')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tour_tag');
    }
};
