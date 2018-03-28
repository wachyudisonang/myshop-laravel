<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    /*Let's add columns for title, description, price, availability */
   public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name')->default('')->unique();
            $table->integer('pack_size')->nullable();
			// $table->string('key')->default('')->unique();
            $table->integer('category_id')->unsigned()->nullable();
			$table->integer('unit_id')->default('0');
        });

        // https://laracasts.com/discuss/channels/eloquent/errno-150-foreign-key-constraint-is-incorrectly-formed/replies/338031
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('product_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
