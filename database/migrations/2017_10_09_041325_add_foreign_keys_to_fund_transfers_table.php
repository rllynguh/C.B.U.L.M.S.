<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFundTransfersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fund_transfers', function(Blueprint $table)
		{
			$table->foreign('bank_id', 'bank_fund')->references('id')->on('banks')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('payment_id', 'payment_fund')->references('id')->on('payments')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('fund_transfers', function(Blueprint $table)
		{
			$table->dropForeign('bank_fund');
			$table->dropForeign('payment_fund');
		});
	}

}
