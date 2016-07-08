<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTaAboutUs extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ta_about_us', function(Blueprint $table)
		{
			$table->increments('aboutus_id');
			$table->string('title1');
			$table->string('title2');
			$table->string('title3');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ta_about_us', function(Blueprint $table)
		{
			//
		});
	}

}
