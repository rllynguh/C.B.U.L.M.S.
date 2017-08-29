<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToContractHeadersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('contract_headers', function(Blueprint $table)
		{
			$table->foreign('registration_header_id', 'regi_contractt')->references('id')->on('registration_headers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('contract_headers', function(Blueprint $table)
		{
			$table->dropForeign('regi_contractt');
		});
	}

}
