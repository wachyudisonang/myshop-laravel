<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
			$table->decimal('amount', 13,2)->default('0');
			$table->integer('store_id')->unsigned()->nullable();
			$table->timestamp('date')->default(now());
			$table->integer('type_id')->unsigned()->nullable();
			$table->integer('bank_id')->unsigned()->nullable();
			$table->integer('instalment')->nullable();
			$table->string('trx_code')->default('')->unique();
        });
        
        Schema::table('payments', function (Blueprint $table) {
            $table->foreign('store_id')->references('id')->on('stores');
            $table->foreign('type_id')->references('id')->on('payment_types');
            $table->foreign('bank_id')->references('id')->on('banks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
