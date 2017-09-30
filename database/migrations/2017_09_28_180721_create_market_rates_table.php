<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMarketRatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('market_rates', function(Blueprint $table)
		{
			$table->integer('city_id')->index('cityRate_idx');
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
		Schema::drop('market_rates');
	}

}
