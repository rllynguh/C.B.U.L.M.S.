<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFundTransfersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fund_transfers', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('bank_id')->index('bank_fund_idx');
			$table->integer('payment_id')->index('payment_fund_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fund_transfers');
	}

}
