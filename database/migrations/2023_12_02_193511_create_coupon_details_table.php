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
        Schema::create('coupon_details', function (Blueprint $table) {
            $table->bigIncrements('coupon_issue_serial');
            $table->string('coupon_code', 255);
            $table->foreign('coupon_code')->references('f_coupon_code')->on('coupons')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupon_details');
    }
};
