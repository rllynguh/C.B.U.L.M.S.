<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToContractTerminationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('contract_terminations', function(Blueprint $table)
		{
			$table->foreign('contract_header_id', 'fk_termi_Contra')->references('id')->on('contract_headers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('contract_terminations', function(Blueprint $table)
		{
			$table->dropForeign('fk_termi_Contra');
		});
	}

}
