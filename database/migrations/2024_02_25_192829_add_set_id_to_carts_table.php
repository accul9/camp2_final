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
        Schema::table('carts', function (Blueprint $table) {
            // Ensure this matches the type and attributes of `set_id` in the `sets` table
            $table->unsignedInteger('set_id')->nullable()->after('item_id');
            // Now, the foreign key reference should be compatible
            $table->foreign('set_id')->references('set_id')->on('sets')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropForeign(['set_id']);
            $table->dropColumn('set_id');
        });
    }
};
