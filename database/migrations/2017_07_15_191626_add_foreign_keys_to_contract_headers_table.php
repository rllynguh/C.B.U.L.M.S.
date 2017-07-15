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
			$table->foreign('offer_sheet_id', 'fk_cont_os')->references('id')->on('offer_sheet_headers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
			$table->dropForeign('fk_cont_os');
		});
	}

}
