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
        Schema::create('usedItems', function (Blueprint $table) {
            $table->increments('usedItem_id');
            $table->unsignedInteger('recipe_id')->nullable();
            $table->foreign('recipe_id')->references('recipe_id')->on('recipes')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->unsignedBigInteger('item_id')->nullable();
            $table->foreign('item_id')->references('item_id')->on('items')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('used_items');
    }
};
