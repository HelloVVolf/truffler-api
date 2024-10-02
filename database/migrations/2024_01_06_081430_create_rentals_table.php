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
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->default(1);
            $table->foreignId('brand_id')->default(1);
            $table->string("slug")->unique();

            $table->string("name");
            $table->unsignedTinyInteger("seat")->default(0);
            $table->unsignedTinyInteger("luggage")->default(0);
            $table->unsignedTinyInteger("door")->default(0);
            $table->string("transmission")->default("Automatic");
            $table->string("fuel")->default("Petrol");
            $table->string("imagePath")->default("");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
