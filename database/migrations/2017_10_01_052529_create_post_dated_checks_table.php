<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostDatedChecksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('post_dated_checks', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('code', 45);
			$table->integer('current_contract_id')->index('current_contract_pdc_idx');
			$table->integer('bank_id')->index('bank_pdc_idx');
			$table->integer('payment_id')->nullable()->index('payment_pdc_idx')->comment('for when the pdc is used for payment');
			$table->float('amount', 10, 0);
			$table->date('date_accepted');
			$table->integer('user_id')->index('user_id_pdc_idx')->comment('accepted by');
			$table->integer('is_consumed')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('post_dated_checks');
	}

}
