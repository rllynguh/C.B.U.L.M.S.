<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRegistrationRequirementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('registration_requirements', function(Blueprint $table)
		{
			$table->foreign('registration_header_id', 'regi_req')->references('id')->on('registration_headers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('requirement_id', 'req_regi')->references('id')->on('requirements')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('registration_requirements', function(Blueprint $table)
		{
			$table->dropForeign('regi_req');
			$table->dropForeign('req_regi');
		});
	}

}
