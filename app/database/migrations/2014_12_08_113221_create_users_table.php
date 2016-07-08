<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('username', 50)->unique();
            $table->string('email')->unique();
            $table->string('firstname', 50);
            $table->string('lastname', 75);
            $table->string('password', 600);
            $table->string('phone');
            $table->date('birth_date');
            $table->boolean('newsletters');
            $table->string('country');
            $table->string('city');
            $table->string('address');
            $table->rememberToken();
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
		Schema::drop('users');
	}

}
