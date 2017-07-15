<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTenantsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tenants', function(Blueprint $table)
		{
			$table->foreign('address_id', 'address_tenant')->references('id')->on('addresses')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('business_type_id', 'types_business')->references('id')->on('business_types')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_id', 'usertenant')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tenants', function(Blueprint $table)
		{
			$table->dropForeign('address_tenant');
			$table->dropForeign('types_business');
			$table->dropForeign('usertenant');
		});
	}

}
