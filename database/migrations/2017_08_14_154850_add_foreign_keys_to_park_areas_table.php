<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToParkAreasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('park_areas', function(Blueprint $table)
		{
			$table->foreign('floor_id', 'fkFloor_Park')->references('id')->on('floors')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('park_areas', function(Blueprint $table)
		{
			$table->dropForeign('fkFloor_Park');
		});
	}

}
