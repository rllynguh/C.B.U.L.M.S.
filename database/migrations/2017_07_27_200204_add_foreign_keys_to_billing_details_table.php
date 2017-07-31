<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBillingDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('billing_details', function(Blueprint $table)
		{
			$table->foreign('billing_header_id', 'fk_bill_bill')->references('id')->on('billing_headers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('billing_details', function(Blueprint $table)
		{
			$table->dropForeign('fk_bill_bill');
		});
	}

}
