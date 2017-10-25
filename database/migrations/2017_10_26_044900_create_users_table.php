<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->enum('type', array('admin','tenant'));
			$table->char('first_name', 45);
			$table->char('middle_name', 45)->nullable();
			$table->char('last_name', 45);
			$table->char('email', 45);
			$table->char('password', 61);
			$table->char('cell_num', 15)->nullable();
			$table->char('picture', 40)->nullable();
			$table->boolean('is_active')->default(0);
			$table->dateTime('last_log_at')->nullable();
			$table->string('remember_token', 61)->nullable();
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
		Schema::drop('users');
	}

}
