<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToContractDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('contract_details', function(Blueprint $table)
		{
			$table->foreign('contract_content_id', 'fk_cont_cont')->references('id')->on('contract_contents')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('contract_header_id', 'fk_cont_headcont')->references('id')->on('contract_headers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('contract_details', function(Blueprint $table)
		{
			$table->dropForeign('fk_cont_cont');
			$table->dropForeign('fk_cont_headcont');
		});
	}

}
