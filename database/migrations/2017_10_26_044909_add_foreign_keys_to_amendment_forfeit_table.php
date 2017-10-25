<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAmendmentForfeitTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('amendment_forfeit', function(Blueprint $table)
		{
			$table->foreign('amendment_id', 'fk_amendment_forfeit_amendment_id')->references('id')->on('amendment')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('unit_id', 'fk_amendment_forfeit_unit_id')->references('id')->on('units')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('amendment_forfeit', function(Blueprint $table)
		{
			$table->dropForeign('fk_amendment_forfeit_amendment_id');
			$table->dropForeign('fk_amendment_forfeit_unit_id');
		});
	}

}
