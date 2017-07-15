<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContractExtendsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contract_extends', function(Blueprint $table)
		{
			$table->integer('contract_header_id')->index('fk_extendContr_idx');
			$table->date('end_of_contract');
			$table->date('extended_at');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('contract_extends');
	}

}
