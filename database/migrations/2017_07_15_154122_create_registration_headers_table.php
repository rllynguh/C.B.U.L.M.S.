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
			$table->date('date_issued');
			$table->text('remarks', 65535);
			$table->integer('is_active')->default(1);
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
