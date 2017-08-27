<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payment_details', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('payment_header_id')->index('payment_detail_header_idx');
			$table->integer('billing_detail_id')->index('billing_detailpayment_idx');
			$table->float('payment', 10, 0);
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
		Schema::drop('payment_details');
	}

}
