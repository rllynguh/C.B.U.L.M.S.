<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBillingNoticesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('billing_notices', function(Blueprint $table)
		{
			$table->foreign('billing_header_id', 'billing_fk_notice')->references('id')->on('billing_headers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('billing_notices', function(Blueprint $table)
		{
			$table->dropForeign('billing_fk_notice');
		});
	}

}
