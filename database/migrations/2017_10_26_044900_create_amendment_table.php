<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAmendmentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('amendment', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('code', 45)->nullable();
			$table->integer('contract_header_id')->unsigned();
			$table->integer('user_id')->nullable()->index('fk_amendment_user_id');
			$table->integer('duration_change')->default(0);
			$table->integer('status')->default(0)->comment('0 - unverified
1-  accepted
2 - rejected');
			$table->text('tenant_remarks', 65535)->nullable();
			$table->text('admin_remarks', 65535)->nullable();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('amendment');
	}

}
