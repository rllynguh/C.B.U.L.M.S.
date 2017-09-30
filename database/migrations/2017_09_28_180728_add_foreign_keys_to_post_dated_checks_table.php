<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPostDatedChecksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('post_dated_checks', function(Blueprint $table)
		{
			$table->foreign('bank_id', 'bank_pdc')->references('id')->on('banks')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('current_contract_id', 'current_contract_pdc')->references('id')->on('current_contracts')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('payment_id', 'payment_pdc')->references('id')->on('payments')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_id', 'user_id_pdc')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('post_dated_checks', function(Blueprint $table)
		{
			$table->dropForeign('bank_pdc');
			$table->dropForeign('current_contract_pdc');
			$table->dropForeign('payment_pdc');
			$table->dropForeign('user_id_pdc');
		});
	}

}
