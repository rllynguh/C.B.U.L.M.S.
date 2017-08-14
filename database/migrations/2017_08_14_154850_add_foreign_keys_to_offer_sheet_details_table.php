<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToOfferSheetDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('offer_sheet_details', function(Blueprint $table)
		{
			$table->foreign('offer_sheet_header_id', 'fk_fofeer')->references('id')->on('offer_sheet_headers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('registration_detail_id', 'fk_regidetial')->references('id')->on('registration_details')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('unit_id', 'unit_idfkkk')->references('id')->on('units')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('offer_sheet_details', function(Blueprint $table)
		{
			$table->dropForeign('fk_fofeer');
			$table->dropForeign('fk_regidetial');
			$table->dropForeign('unit_idfkkk');
		});
	}

}
