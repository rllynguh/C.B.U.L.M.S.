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
			$table->integer('advance_rent_rate')->default(3);
			$table->float('vat_rate', 10, 0)->unsigned()->default(12);
			$table->float('ewt_rate', 10, 0)->unsigned()->default(5);
			$table->float('escalation_rate', 10, 0)->unsigned()->default(1);
			$table->float('vetting_fee', 10, 0)->unsigned()->default(100);
			$table->float('fit_out_deposit', 10, 0)->default(1);
			$table->integer('for_interest_days')->default(60)->comment('number of days before considered to have an interest');
			$table->integer('billing_day')->default(6)->comment('the day of billing 
ex: every 6th of the month');
			$table->float('delayed_interest', 10, 0)->default(1)->comment('percentage of interest per day when payment is incomplete');
			$table->dateTime('date_as_of');
			$table->integer('days_before_termination')->default(60);
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
