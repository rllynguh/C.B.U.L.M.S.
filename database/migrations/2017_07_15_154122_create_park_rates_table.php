<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateParkRatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('park_rates', function(Blueprint $table)
		{
			$table->integer('building_id')->index('builParkRate_idx');
			$table->float('rate', 10, 0);
			$table->dateTime('date_as_of');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('park_rates');
	}

}
