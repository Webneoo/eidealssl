<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateTaBrands extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('ta_brands', function($table)
        {
            $table->string('brand_title');
            $table->string('brand_logo');
            $table->string('title1');
            $table->text('desc1');
            $table->string('title2');
            $table->text('desc2');
            $table->string('title3');
            $table->text('desc3');
            $table->string('title4');
            $table->text('desc4');
            $table->string('title5');
            $table->text('desc5');

        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        //
	}

}
