<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRegistrationHeadersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('registration_headers', function(Blueprint $table)
		{
			$table->foreign('tenant_id', 'fk_customer')->references('id')->on('tenants')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('registration_headers', function(Blueprint $table)
		{
			$table->dropForeign('fk_customer');
		});
	}

}
