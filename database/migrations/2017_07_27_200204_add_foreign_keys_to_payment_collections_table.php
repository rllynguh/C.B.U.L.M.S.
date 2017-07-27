<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPaymentCollectionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('payment_collections', function(Blueprint $table)
		{
			$table->foreign('bank_id', 'str_bank_')->references('id')->on('banks')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('contract_header_id', 'str_pay_contra_')->references('id')->on('contract_headers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('payment_collections', function(Blueprint $table)
		{
			$table->dropForeign('str_bank_');
			$table->dropForeign('str_pay_contra_');
		});
	}

}
