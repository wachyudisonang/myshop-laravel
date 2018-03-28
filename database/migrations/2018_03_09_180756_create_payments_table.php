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
			$table->integer('store_id')->nullable();
			$table->timestamp('date')->default(now());
			$table->integer('type_id')->default('1');
			$table->integer('bank_id')->nullable();
			$table->integer('instalment')->nullable();
			$table->string('trx_code')->default('')->unique();
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
