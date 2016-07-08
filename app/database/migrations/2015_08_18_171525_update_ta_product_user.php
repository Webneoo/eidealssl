<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
            $table->integer('price');
            $table->integer('quantity');
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
        Schema::drop('ta_product_user');
	}

}
