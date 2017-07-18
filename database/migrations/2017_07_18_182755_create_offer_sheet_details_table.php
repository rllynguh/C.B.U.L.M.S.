<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOfferSheetDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('offer_sheet_details', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('registration_detail_id')->index('fk_regidetial_idx');
			$table->integer('offer_sheet_header_id')->index('fk_fofeer_idx');
			$table->integer('unit_id')->index('unit_idfkkk_idx');
			$table->boolean('is_accepted')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('offer_sheet_details');
	}

}
