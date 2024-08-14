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
        Schema::create('recipes', function (Blueprint $table) {
            $table->increments('recipe_id');
            $table->string('recipe_name');
            $table->longText('recipe_description');
            $table->string('recipe_image')->nullable();
            $table->unsignedInteger('set_id')->nullable();
            $table->foreign('set_id')->references('set_id')->on('sets')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
