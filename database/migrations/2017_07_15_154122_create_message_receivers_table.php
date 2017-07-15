<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMessageReceiversTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('message_receivers', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->index('recuser_idx');
			$table->integer('sender_id')->index('int_sendrec_idx');
			$table->boolean('is_read')->default(0);
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
		Schema::drop('message_receivers');
	}

}
