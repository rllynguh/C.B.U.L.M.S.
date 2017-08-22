<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToContractContentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('contract_contents', function(Blueprint $table)
		{
			$table->foreign('content_id', 'contractcontentcont')->references('id')->on('contents')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('contract_header_id', 'contractontentheader')->references('id')->on('contract_headers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('contract_contents', function(Blueprint $table)
		{
			$table->dropForeign('contractcontentcont');
			$table->dropForeign('contractontentheader');
		});
	}

}
