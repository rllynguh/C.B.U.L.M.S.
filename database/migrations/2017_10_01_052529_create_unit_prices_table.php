<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUnitPricesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('unit_prices', function(Blueprint $table)
		{
			$table->integer('unit_id')->index('fk_unitpriceunit_idx');
			$table->dateTime('date_as_of');
			$table->float('price', 10, 0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('unit_prices');
	}

}
