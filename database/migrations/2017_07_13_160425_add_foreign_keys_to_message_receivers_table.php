<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMessageReceiversTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('message_receivers', function(Blueprint $table)
		{
			$table->foreign('sender_id', 'int_send_rec')->references('id')->on('message_senders')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_id', 'rec_user')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('message_receivers', function(Blueprint $table)
		{
			$table->dropForeign('int_send_rec');
			$table->dropForeign('rec_user');
		});
	}

}
