<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContractHeadersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contract_headers', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('registration_header_id')->index('regi_contractt_idx');
			$table->string('code', 45)->unique('code_UNIQUE');
			$table->integer('user_id');
			$table->date('date_issued');
			$table->float('escalation_rate', 10, 0);
			$table->date('end_of_contract');
			$table->date('date_of_billing');
			$table->integer('status')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('contract_headers');
	}

}
