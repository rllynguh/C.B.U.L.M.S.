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
			$table->integer('user_id')->index('fk_user_bill_idx')->comment('who bills the tenant');
			$table->string('code', 45);
			$table->date('date_issued');
			$table->integer('current_contract_id')->index('currenbill_idx');
			$table->float('cost', 10, 0)->comment('negative for increase in balance');
			$table->integer('status')->default(0)->comment('0 - unpaid
1-  paid
2 - terminated');;
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
