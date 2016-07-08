<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTaProductUser extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::drop('ta_product_user');
        Schema::create('ta_product_user', function(Blueprint $table)
		{
            $table->increments('transaction_id');
            $table->integer('product_id');
            $table->integer('user_id');
            $table->integer('purchase_date');
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
