<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPaymentDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('payment_details', function(Blueprint $table)
		{
			$table->foreign('billing_detail_id', 'billing_detailpayment')->references('id')->on('billing_details')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('payment_header_id', 'payment_detail_header')->references('id')->on('payment_headers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('payment_details', function(Blueprint $table)
		{
			$table->dropForeign('billing_detailpayment');
			$table->dropForeign('payment_detail_header');
		});
	}

}
