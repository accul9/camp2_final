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
        Schema::table('usedItems', function (Blueprint $table) {
            $table->string('usedItem_quantity')->default("")->after('item_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usedItems', function (Blueprint $table) {
            $table->dropColumn('usedItem_quantity');
        });
    }
};
