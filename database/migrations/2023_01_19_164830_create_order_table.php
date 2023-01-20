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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->integer('kasir_id');
            $table->integer('menu_id');
            $table->integer('topping_id');
            $table->timestamps();
            

            // $table->id();
            // $table->string('nama');
            // $table->string('deskripsi');
            // $table->integer('amount');
            // $table->integer('stock')->nullable();
            // $table->string('image')->nullable();
            // $table->enum('kategori', ['Makanan', 'Minuman','Topping']);
            // $table->string('is_active')->default(0);
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
};
