<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveBelongedSetIdFromItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            // 外部キー制約を削除
            $table->dropForeign('items_belongedset_id_foreign');
            // カラムを削除
            $table->dropColumn('belongedSet_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            // カラムを再作成
            $table->integer('belongedSet_id')->after('category_id');
            // 外部キー制約を再作成
            $table->foreign('belongedSet_id')->references('set_id')->on('sets');
        });
    }
}
