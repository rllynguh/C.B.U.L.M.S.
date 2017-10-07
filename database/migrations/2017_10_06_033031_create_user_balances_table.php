<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserBalancesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_balances', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->index('user_balance');
			$table->date('date_as_of');
			$table->float('balance', 10, 0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_balances');
	}

}
