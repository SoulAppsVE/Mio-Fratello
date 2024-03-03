<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotationds', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('quotation_id')->unsigned();
            $table->foreign('quotation_id')->references('id')->on('quotations')->onDelete('cascade');
            $table->Integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');
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
        Schema::dropIfExists('quotationds');
    }
}
