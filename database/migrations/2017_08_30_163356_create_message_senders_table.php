<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMessageSendersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('message_senders', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->index('senduser_idx');
			$table->char('title', 45);
			$table->text('content', 65535);
			$table->char('pdf', 50)->nullable();
			$table->dateTime('created_at');
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('message_senders');
	}

}
