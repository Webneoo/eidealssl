<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTaProductUser extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ta_product_user', function(Blueprint $table)
		{
			$table->integer('product_id');
            $table->integer('user_id');
            $table->integer('purchase_date');
            $table->primary(array('product_id', 'user_id', 'purchase_date'));
            $table->integer('status_id');
            $table->float('price');
            $table->integer('quantity');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ta_product_user');
	}

}
