<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
			//
            $table->increments('id');
            $table->string('email')->unque();
            $table->string('password');
            $table->string('username');
            $table->string('active');
            $table->string('password_stemp');
            $table->string('remember_token');
            $table->string('code');
            $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	/*public function down()
	{
		Schema::table('users', function(Blueprint $table)
		{
			//
		});
	}*/

}
