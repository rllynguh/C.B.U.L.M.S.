<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFloorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('floors', function(Blueprint $table)
		{
			$table->foreign('building_id', 'fk_buil_floor')->references('id')->on('buildings')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('floors', function(Blueprint $table)
		{
			$table->dropForeign('fk_buil_floor');
		});
	}

}
