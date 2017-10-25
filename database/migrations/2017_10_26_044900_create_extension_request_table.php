<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExtensionRequestTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('extension_request', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('tenant_user_id');
			$table->integer('current_contract_id');
			$table->integer('duration');
			$table->integer('status')->default(0)->comment('0 = Unaccepted 1 = Accepted 2 = Rejected');
			$table->text('type', 65535);
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('extension_request');
	}

}
