<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOfferSheetHeadersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('offer_sheet_headers', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('code', 45);
			$table->integer('user_id')->index('user_generate_idx');
			$table->text('tenant_remarks', 65535)->nullable();
			$table->date('date_issued');
			$table->integer('status')->default(0);
			$table->integer('isAmendment')->default(0)->comment('1 = part of amendment')
			$table->string('contract_header_id')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('offer_sheet_headers');
	}

}
