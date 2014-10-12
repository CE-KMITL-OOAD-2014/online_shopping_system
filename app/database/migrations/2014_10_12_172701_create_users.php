<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
          Schema::create('users', function($table){
            $table->increments('id');
            $table->string('username', 30)->unique();
            $table->string('password', 30);
            $table->string('permission', 10);
            $table->string('address', 200);
            $table->string('phone', 20)->unique();
            $table->string('email', 25)->unique();
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
