<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToParkSpacesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('park_spaces', function(Blueprint $table)
		{
			$table->foreign('park_area_id', 'parkAre_aSpace')->references('id')->on('park_areas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('park_spaces', function(Blueprint $table)
		{
			$table->dropForeign('parkAre_aSpace');
		});
	}

}
