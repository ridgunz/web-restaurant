<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_topping', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('order_detail_id');
            $table->integer('id_topping');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_topping', function (Blueprint $table) {
            Schema::dropIfExists('detail_topping');
        });
    }
};
