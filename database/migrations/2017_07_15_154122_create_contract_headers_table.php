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
			$table->string('code', 45)->unique('code_UNIQUE');
			$table->integer('offer_sheet_id')->index('fk_cont_os_idx');
			$table->date('end_of_contract');
			$table->date('date_issued');
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
