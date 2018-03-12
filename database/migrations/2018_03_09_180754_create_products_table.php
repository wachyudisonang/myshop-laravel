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
            $table->increments('ID');
			$table->string('Name')->default('');
            $table->string('Variant')->default('');
            $table->integer('PackSize')->default('0');
			$table->string('Key')->default('')->unique();
            $table->integer('CategoryID')->unsigned();
			$table->integer('UnitID')->default('0');
        });

        // https://laracasts.com/discuss/channels/eloquent/errno-150-foreign-key-constraint-is-incorrectly-formed/replies/338031
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('CategoryID')->references('ID')->on('product_categories');
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
