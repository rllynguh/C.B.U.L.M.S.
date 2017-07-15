<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateParkSpacesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('park_spaces', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->char('description', 10);
			$table->integer('park_area_id')->index('parkAreaSpace_idx');
			$table->integer('number');
			$table->float('size', 10, 0);
			$table->boolean('is_active')->default(1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('park_spaces');
	}

}
