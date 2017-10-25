<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRepresentativesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('representatives', function(Blueprint $table)
		{
			$table->foreign('user_id', 'fk_Userrepr_')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('representative_position_id', 'fk_representativepos_')->references('id')->on('representative_positions')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('representatives', function(Blueprint $table)
		{
			$table->dropForeign('fk_Userrepr_');
			$table->dropForeign('fk_representativepos_');
		});
	}

}
