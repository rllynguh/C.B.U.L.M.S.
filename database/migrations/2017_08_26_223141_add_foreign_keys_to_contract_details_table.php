<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToContractDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('contract_details', function(Blueprint $table)
		{
			$table->foreign('current_contract_id', 'fk_cont_headcont')->references('id')->on('current_contracts')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('unit_id', 'unit_fk_contracc')->references('id')->on('units')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('contract_details', function(Blueprint $table)
		{
			$table->dropForeign('fk_cont_headcont');
			$table->dropForeign('unit_fk_contracc');
		});
	}

}
