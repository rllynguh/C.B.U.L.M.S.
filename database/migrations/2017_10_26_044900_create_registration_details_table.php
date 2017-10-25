<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRegistrationDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('registration_details', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('registration_header_id')->nullable()->index('fk_regihCOde_idx');
			$table->integer('amendment_id')->unsigned()->nullable()->index('fk_regi_amendment_id');
			$table->text('tenant_remarks', 65535)->nullable();
			$table->text('admin_remarks', 65535)->nullable();
			$table->boolean('is_rejected')->default(0)->comment('0 - unverified
1 - accepted
2 - rejected');
			$table->boolean('is_forfeited')->default(0);
			$table->boolean('is_reserved')->default(0);
			$table->boolean('is_amendment')->default(0);
			$table->integer('unit_id')->index('fk_unit_detail_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('registration_details');
	}

}
