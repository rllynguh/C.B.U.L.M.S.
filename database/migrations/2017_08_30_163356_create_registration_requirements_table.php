<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRegistrationRequirementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('registration_requirements', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('registration_header_id')->index('regi_req_idx');
			$table->integer('requirement_id')->index('req_regi_idx');
			$table->string('pdf', 60)->nullable();
			$table->boolean('status')->default(0)->comment('0-unverified
1-fulfilled
2-needs revision');
			$table->date('date_fulfilled')->nullable();
			$table->text('admin_remarks', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('registration_requirements');
	}

}
