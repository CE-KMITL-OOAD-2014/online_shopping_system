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
            $table->string('username', 30)->unique()->nullable(false);
            $table->string('password', 65)->nullable(false);
            $table->string('permission', 10)->nullable(false);
            $table->string('address', 200)->nullable(false);
            $table->string('phone', 20)->unique()->nullable(false);
            $table->string('email', 25)->unique()->nullable(false);
            $table->string('remember_token', 100)->nullable();
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
          Schema::drop('User');
	}

}
