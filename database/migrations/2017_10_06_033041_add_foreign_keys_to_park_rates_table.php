<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToParkRatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('park_rates', function(Blueprint $table)
		{
			$table->foreign('building_id', 'builPark_Rate')->references('id')->on('buildings')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('park_rates', function(Blueprint $table)
		{
			$table->dropForeign('builPark_Rate');
		});
	}

}
