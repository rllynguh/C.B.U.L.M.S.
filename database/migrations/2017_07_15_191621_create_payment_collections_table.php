<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentCollectionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payment_collections', function(Blueprint $table)
		{
			$table->integer('id')->primary();
			$table->string('code', 45);
			$table->integer('contract_header_id')->index('str_pay_contra_');
			$table->integer('payment_mode_id')->default(0)->comment('0-cash,1-post-datedcheque');
			$table->date('date_issued');
			$table->integer('bank_id')->index('str_bank_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('payment_collections');
	}

}
