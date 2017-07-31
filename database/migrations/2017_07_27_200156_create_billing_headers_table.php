<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBillingHeadersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('billing_headers', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('contract_header_id')->index('fk_bill_contract_idx');
			$table->integer('user_id')->index('fk_user_bill_idx');
			$table->string('code', 45);
			$table->date('date_issued');
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
		Schema::drop('billing_headers');
	}

}
