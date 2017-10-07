<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateParkAreasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('park_areas', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->char('description', 10);
			$table->integer('floor_id')->index('fkFloorPark_idx');
			$table->integer('num_of_space');
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
		Schema::drop('park_areas');
	}

}
