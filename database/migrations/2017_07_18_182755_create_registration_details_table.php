<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRegistrationDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('registration_details', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('registration_header_id')->index('fk_regihCOde_idx');
			$table->integer('building_type_id');
			$table->float('size_from', 10, 0);
			$table->float('size_to', 10, 0);
			$table->boolean('unit_type');
			$table->integer('floor');
			$table->boolean('status')->default(1);
			$table->text('remarks', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('registration_details');
	}

}
