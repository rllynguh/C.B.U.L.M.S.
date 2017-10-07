<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUnitPricesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('unit_prices', function(Blueprint $table)
		{
			$table->foreign('unit_id', 'fk_unitpriceunit_')->references('id')->on('units')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('unit_prices', function(Blueprint $table)
		{
			$table->dropForeign('fk_unitpriceunit_');
		});
	}

}
