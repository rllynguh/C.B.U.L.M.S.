<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBillingNoticesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('billing_notices', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('billing_header_id')->index('billing_fk_notice_idx');
			$table->string('pdf', 65);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('billing_notices');
	}

}
