<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRegistrationHeadersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('registration_headers', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('code', 45)->nullable();
			$table->integer('tenant_id')->index('fk_cusomer_idx');
			$table->integer('user_id')->nullable()->index('user_signed_idx');
			$table->integer('duration_preferred');
			$table->date('date_issued');
			$table->text('tenant_remarks', 65535)->nullable();
			$table->text('admin_remarks', 65535)->nullable();
			$table->integer('status')->default(0)->comment('0 - unverified
1-  accepted
2 - rejected');
			$table->integer('is_forfeited')->default(0)->comment('if customer forfeits his transaction');
			$table->integer('is_existing_tenant')->default(0)->comment('0 - registration is from new tenant
				1 - registration is from existing tenant');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('registration_headers');
	}

}
