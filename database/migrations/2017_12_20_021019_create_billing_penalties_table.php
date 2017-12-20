<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBillingPenaltiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('billing_penalties', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('billing_header_id')->index('billing_header_penalty_idx');
			$table->integer('penalty_id')->index('penalty_billing_idx');
			$table->integer('is_active')->default(1);
			$table->date('date_as_of');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('billing_penalties');
	}

}
