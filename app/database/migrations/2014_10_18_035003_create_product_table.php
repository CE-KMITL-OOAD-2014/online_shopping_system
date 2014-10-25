<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products',function($table){
			$table->increments('id');
			$table->double('price');
			$table->string('category',30);
			$table->string('description',300);
			$table->string('size',5);
			$table->string('color',10);
			$table->string('suplier',30);
			$table->integer('amount');
			$table->string('imgPath',50);
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
		Schema::drop('products');
	}

}
