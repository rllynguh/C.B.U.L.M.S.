<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDatedChecksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dated_checks', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('payment_id')->index('fk_pay_dated_idx');
			$table->integer('bank_id')->index('fk_bank_dated_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('dated_checks');
	}

}
