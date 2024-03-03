<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdercdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordercds', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('orderc_id')->unsigned();
            $table->foreign('orderc_id')->references('id')->on('ordercs')->onDelete('cascade');
            $table->Integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');
           // $table->integer('quantity');
            $table->decimal('quantity');
            $table->decimal('subtotal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordercds');
    }
}
