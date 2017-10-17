<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToAmendmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('amendment', function(Blueprint $table)
        {
           $table->foreign('user_id','fk_amendment_user_id')
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
        Schema::table('registration_details', function(Blueprint $table)
        {
            $table->dropForeign('fk_amendment_user_id');
        });
    }
}
