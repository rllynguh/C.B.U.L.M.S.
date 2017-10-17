<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDatedChecksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('dated_checks', function(Blueprint $table)
		{
			$table->foreign('bank_id', 'fk_bank_dated')->references('id')->on('banks')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('payment_id', 'fk_pay_dated')->references('id')->on('payments')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('dated_checks', function(Blueprint $table)
		{
			$table->dropForeign('fk_bank_dated');
			$table->dropForeign('fk_pay_dated');
		});
	}

}
