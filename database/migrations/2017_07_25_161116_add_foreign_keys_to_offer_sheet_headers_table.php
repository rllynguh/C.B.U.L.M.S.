<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToOfferSheetHeadersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('offer_sheet_headers', function(Blueprint $table)
		{
			$table->foreign('user_id', 'user_generate')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('offer_sheet_headers', function(Blueprint $table)
		{
			$table->dropForeign('user_generate');
		});
	}

}
