<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('product_id')->unsigned();
            $table->decimal('unit_price', 13,2)->default('0');
            $table->integer('qty')->default('1');
            $table->integer('payment_id')->unsigned()->nullable();
		});
		
		Schema::table('purchases', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('payment_id')->references('id')->on('payments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchases');
    }
}
