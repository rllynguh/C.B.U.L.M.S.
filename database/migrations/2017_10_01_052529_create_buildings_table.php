<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBuildingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('buildings', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->char('code', 20)->unique('code_UNIQUE');
			$table->char('description', 30)->unique('strBuilDesc_UNIQUE');
			$table->integer('building_type_id')->index('fk__idx');
			$table->integer('num_of_floor');
			$table->integer('address_id')->index('fk_builaddcode_idx');
			$table->boolean('is_active')->default(1);
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
		Schema::drop('buildings');
	}

}
