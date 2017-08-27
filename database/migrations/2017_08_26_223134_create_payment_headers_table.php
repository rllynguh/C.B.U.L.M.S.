<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentHeadersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payment_headers', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('bank_id')->index('str_bank_idx');
			$table->string('code', 45);
			$table->date('date_issued');
			$table->date('date_collected');
			$table->integer('user_id')->index('user_id_header_idx');
			$table->boolean('status')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('payment_headers');
	}

}
