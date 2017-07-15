<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUnitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('units', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->char('code', 20);
			$table->boolean('type')->comment('0-Raw
1-Shell');
			$table->float('size', 10, 0);
			$table->integer('floor_id')->index('fk_floor_unit_idx');
			$table->integer('number');
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
		Schema::drop('units');
	}

}
