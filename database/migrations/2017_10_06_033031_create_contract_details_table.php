<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContractDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contract_details', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('current_contract_id')->index('fk_cont_headcont_idx');
			$table->integer('unit_id')->index('unit_fk_contracc_idx');
			$table->float('price', 10, 0);
			$table->boolean('status')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('contract_details');
	}

}
