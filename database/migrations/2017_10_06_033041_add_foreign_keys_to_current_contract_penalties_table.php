<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCurrentContractPenaltiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('current_contract_penalties', function(Blueprint $table)
		{
			$table->foreign('current_contract_id', 'current_contractsss')->references('id')->on('current_contracts')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('penalty_id', 'fk_penalty_current')->references('id')->on('penalties')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('current_contract_penalties', function(Blueprint $table)
		{
			$table->dropForeign('current_contractsss');
			$table->dropForeign('fk_penalty_current');
		});
	}

}
