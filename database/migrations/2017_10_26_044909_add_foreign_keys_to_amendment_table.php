<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAmendmentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('amendment', function(Blueprint $table)
		{
			$table->foreign('user_id', 'fk_amendment_user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('amendment', function(Blueprint $table)
		{
			$table->dropForeign('fk_amendment_user_id');
		});
	}

}
