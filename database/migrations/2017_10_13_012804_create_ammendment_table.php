<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmmendmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ammendment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contract_header_id');
            $table->integer('user_id');
            $table->integer('duration_change')->default(0);
            $table->integer('status')->default(0)->comment('0 - unverified
1-  accepted
2 - rejected');
            $table->text('tenant_remarks', 65535)->nullable();
            $table->text('admin_remarks', 65535)->nullable();
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
        Schema::dropIfExists('ammendment');
    }
}
