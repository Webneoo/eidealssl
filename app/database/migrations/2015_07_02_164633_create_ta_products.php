<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTaProducts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ta_products', function(Blueprint $table)
		{
			$table->increments('product_id');
            $table->string('code');
            $table->string('title');
            $table->text('small_desc');
            $table->text('text');
            $table->float('price');
            $table->string('img1');
            $table->string('img2');
            $table->string('img3');
            $table->string('img4');
            $table->boolean('best_seller');
            $table->integer('category_id');
            $table->integer('sub_category_id');
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
		Schema::drop('ta_products');
	}

}
