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
        Schema::table('users', function (Blueprint $table) {
            $table->string('user_postcode')->nullable();
            $table->string('user_address')->nullable();
            $table->string('user_phone')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('user_postcode')->nullable(false);
            $table->dropColumn('user_address')->nullable(false);
            $table->dropColumn('user_phone')->nullable(false);
        });
    }
};
