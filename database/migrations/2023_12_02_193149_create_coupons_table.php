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
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('f_coupon_id');
            $table->string('f_coupon_code', 255)->unique();
            // $table->integer('f_coupon_type_id')->unsigned()->nullable();
            // $table->foreign('f_coupon_type_id')->references('f_coupon_type_id')->on('coupon_types')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->date('f_coupon_valid_date');
            $table->date('f_coupon_expired_date');
            $table->integer('f_coupon_amount')->unsigned();
            $table->integer('f_coupon_max')->unsigned()->nullable();
            $table->integer('f_coupon_min_total')->unsigned()->nullable();
            $table->integer('f_coupon_max_per_user')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
