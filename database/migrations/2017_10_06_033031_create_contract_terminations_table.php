<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContractTerminationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contract_terminations', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('code', 45);
			$table->integer('contract_header_id')->index('fk_termiContra_idx');
			$table->date('date_ended');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('contract_terminations');
	}

}
