<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMoveInDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('move_in_details', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('move_in_header_id')->index('moveinheaderdetailbonding_idx');
			$table->integer('contract_detail_id')->index('contractdetail_movein_idx');
			$table->integer('is_active')->default(1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('move_in_details');
	}

}
