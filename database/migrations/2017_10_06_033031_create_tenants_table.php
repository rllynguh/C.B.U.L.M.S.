<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTenantsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tenants', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('code', 45);
			$table->char('description', 50)->unique('strTenaDesc_UNIQUE');
			$table->integer('business_type_id')->index('busitype_idx');
			$table->integer('user_id')->index('user_idx');
			$table->integer('address_id')->index('qwede_idx');
			$table->boolean('is_active')->default(1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tenants');
	}

}
