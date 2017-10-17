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
			$table->integer('registration_header_id')->index('fk_regihCOde_idx')->nullable();
			$table->integer('amendment_id')->unsigned()->nullable();
			$table->integer('building_type_id');
			$table->float('size_from', 10, 0);
			$table->float('size_to', 10, 0);
			$table->boolean('unit_type');
			$table->integer('floor');
			$table->text('tenant_remarks', 65535)->nullable();
			$table->text('admin_remarks', 65535)->nullable();
			$table->boolean('is_rejected')->default(0)->comment('0 - unverified
1 - accepted
2 - rejected');
			$table->boolean('is_forfeited')->default(0);
			$table->boolean('is_reserved')->default(0);
			$table->boolean('is_amendment')->default(0);
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
