<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBillingHeadersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('billing_headers', function(Blueprint $table)
		{
			$table->foreign('current_contract_id', 'currenbill')->references('id')->on('current_contracts')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_id', 'fk_user_bill')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('billing_headers', function(Blueprint $table)
		{
			$table->dropForeign('currenbill');
			$table->dropForeign('fk_user_bill');
		});
	}

}
