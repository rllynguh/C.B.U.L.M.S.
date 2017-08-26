<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMoveInDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('move_in_details', function(Blueprint $table)
		{
			$table->foreign('contract_detail_id', 'contractdetail_movein')->references('id')->on('contract_details')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('move_in_header_id', 'moveinheaderdetailbonding')->references('id')->on('move_in_headers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('move_in_details', function(Blueprint $table)
		{
			$table->dropForeign('contractdetail_movein');
			$table->dropForeign('moveinheaderdetailbonding');
		});
	}

}
