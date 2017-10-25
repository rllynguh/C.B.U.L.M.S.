<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRepresentativesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('representatives', function(Blueprint $table)
		{
			$table->integer('user_id')->index('fk_Userrepr_idx');
			$table->integer('representative_position_id')->index('fk_representativepos_idx');
			$table->char('tel_num', 20)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('representatives');
	}

}
