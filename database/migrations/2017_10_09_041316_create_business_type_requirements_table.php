<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBusinessTypeRequirementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('business_type_requirements', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('business_type_id')->index('busi_req_idx');
			$table->integer('requirement_id')->index('req_busi_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('business_type_requirements');
	}

}
