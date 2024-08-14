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
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('item_id');
            $table->string('item_name')->unique();
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('category_id')->on('categories');
            $table->string('item_unit');
            $table->integer('item_price');
            $table->string('item_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
