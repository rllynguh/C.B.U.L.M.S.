<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUtilitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('utilities', function(Blueprint $table)
		{
			$table->float('cusa_rate', 10, 0)->unsigned()->default(80);
			$table->float('reservation_fee', 10, 0)->default(1);
			$table->integer('security_deposit_rate')->unsigned()->default(3)->comment('number of months for security deposit');
			$table->float('vat_rate', 10, 0)->unsigned()->default(12);
			$table->float('ewt_rate', 10, 0)->unsigned()->default(1);
			$table->float('escalation_rate', 10, 0)->unsigned()->default(1);
			$table->float('vetting_fee', 10, 0)->unsigned()->default(100);
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
		Schema::drop('utilities');
	}

}
