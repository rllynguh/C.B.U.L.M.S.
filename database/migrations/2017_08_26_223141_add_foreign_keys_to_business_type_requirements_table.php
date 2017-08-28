<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBusinessTypeRequirementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('business_type_requirements', function(Blueprint $table)
		{
			$table->foreign('business_type_id', 'busi_req')->references('id')->on('business_types')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('requirement_id', 'req_busi')->references('id')->on('requirements')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('business_type_requirements', function(Blueprint $table)
		{
			$table->dropForeign('busi_req');
			$table->dropForeign('req_busi');
		});
	}

}
