<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCurrentContractsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('current_contracts', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('contract_header_id')->index('contract_header_curretn_idx');
			$table->integer('user_id')->index('user_id_idx')->comment('admin_id');
			$table->date('date_issued');
			$table->date('date_of_billing');
			$table->date('end_of_contract');
			$table->date('start_of_contract');
			$table->string('pdf', 60);
			$table->boolean('status')->default(0)->comment('0 - default 1 - idk 2 - terminated');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('current_contracts');
	}

}
