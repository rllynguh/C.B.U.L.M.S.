<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMoveInHeadersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('move_in_headers', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('code', 45);
			$table->date('date_issued');
			$table->date('date_moved_in');
			$table->integer('user_id');
			$table->boolean('status')->default(0);
			$table->text('remarks', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('move_in_headers');
	}

}
