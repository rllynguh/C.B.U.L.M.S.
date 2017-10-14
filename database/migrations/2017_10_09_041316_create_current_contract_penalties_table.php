<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCurrentContractPenaltiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('current_contract_penalties', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('current_contract_id')->index('current_contractsss');
			$table->integer('penalty_id')->index('fk_penalty_current_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('current_contract_penalties');
	}

}
