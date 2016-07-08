<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTaStoreLocator extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ta_store_locator', function(Blueprint $table)
		{
			$table->increments('locator_id');
            $table->string('name');
            $table->string('region');
            $table->string('address');
            $table->string('phone');
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
		Schema::drop('ta_store_locator');
	}

}
