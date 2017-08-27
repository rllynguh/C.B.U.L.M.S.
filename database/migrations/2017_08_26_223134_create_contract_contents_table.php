<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContractContentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contract_contents', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('contract_header_id')->index('contractontentheader_idx');
			$table->integer('content_id')->index('contractcontentcont_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('contract_contents');
	}

}
