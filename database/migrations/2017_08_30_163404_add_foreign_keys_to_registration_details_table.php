<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRegistrationDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('registration_details', function(Blueprint $table)
		{
			$table->foreign('registration_header_id', 'fk_regi_COde')->references('id')->on('registration_headers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('registration_details', function(Blueprint $table)
		{
			$table->dropForeign('fk_regi_COde');
		});
	}

}
