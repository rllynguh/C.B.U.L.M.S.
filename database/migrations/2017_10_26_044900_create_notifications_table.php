<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notifications', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->index('user_notification_idx');
			$table->string('title', 45);
			$table->text('description', 65535);
			$table->string('link', 60);
			$table->date('date_issued');
			$table->date('date_read')->nullable();
			$table->integer('is_read')->default(0);
			$table->boolean('is_urgent')->default(0);
			$table->string('type', 60)->nullable()->comment('billing/termination/amendment status');
			$table->integer('current_contract_id')->nullable();
			$table->integer('expires_on')->default(0);
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
		Schema::drop('notifications');
	}

}
