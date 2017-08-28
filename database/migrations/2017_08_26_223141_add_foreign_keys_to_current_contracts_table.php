<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCurrentContractsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('current_contracts', function(Blueprint $table)
		{
			$table->foreign('contract_header_id', 'contract_header_curretn')->references('id')->on('contract_headers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_id', 'user_id')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('current_contracts', function(Blueprint $table)
		{
			$table->dropForeign('contract_header_curretn');
			$table->dropForeign('user_id');
		});
	}

}
