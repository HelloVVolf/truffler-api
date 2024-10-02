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
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->foreignId("place_category_id")->default(1);
            $table->foreignId("subdistrict_id")->default(1);
            $table->string("slug")->unique();
            $table->string("name");
            $table->time('open_time')->nullable();
            $table->time('closed_time')->nullable();
            $table->text("about")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('places');
    }
};
