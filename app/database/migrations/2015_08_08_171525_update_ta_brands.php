<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateTaBrands2 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::drop('ta_brands');

        Schema::create('ta_brands', function(Blueprint $table)
        {
            $table->increments('brand_id');
            $table->string('brand_title');
            $table->string('brand_logo')->nullable();;
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
        //
	}

}
