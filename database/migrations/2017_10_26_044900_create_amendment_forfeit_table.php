<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAmendmentForfeitTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('amendment_forfeit', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('amendment_id')->unsigned()->index('fk_amendment_forfeit_amendment_id');
			$table->integer('unit_id')->index('fk_amendment_forfeit_unit_id');
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
		Schema::drop('amendment_forfeit');
	}

}
