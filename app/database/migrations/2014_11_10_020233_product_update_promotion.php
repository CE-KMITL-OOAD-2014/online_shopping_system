<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductUpdatePromotion extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('products', function($table)
		{
    		$table->integer('pro_percent')->default(0);
    		$table->string('pro_type')->default("");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('products', function($table)
		{
    		$table->dropColumn('pro_percent');
    		$table->dropColumn('pro_type');
		});
	}

}
