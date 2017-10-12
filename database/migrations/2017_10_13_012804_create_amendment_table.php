<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmendmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amendment', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 45)->nullable();
            $table->integer('contract_header_id');
            $table->integer('user_id')->nullable();
            $table->integer('duration_change')->default(0);
            $table->integer('status')->default(0)->comment('0 - unverified
1-  accepted
2 - rejected');
            $table->text('tenant_remarks', 65535)->default('N/A');
            $table->text('admin_remarks', 65535)->default('N/A');
            $table->timestamps();
            $table->foreign('user_id')
          ->references('id')->on('users')
          ->onDelete('restrict')
          ->onUpdate('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('amendment');
    }
}
