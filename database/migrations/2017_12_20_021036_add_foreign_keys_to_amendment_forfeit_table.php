<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToAmendmentForfeitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('amendment_forfeit', function(Blueprint $table)
        {
            $table->foreign('amendment_id','fk_amendment_forfeit_amendment_id')
              ->references('id')->on('amendment')
              ->onDelete('restrict')
              ->onUpdate('cascade');
            $table->foreign('unit_id','fk_amendment_forfeit_unit_id')
            ->references('id')->on('units')
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
        Schema::table('amendment_forfeit', function(Blueprint $table)
        {
            $table->dropForeign('fk_amendment_forfeit_amendment_id');
            $table->dropForeign('fk_amendment_forfeit_unit_id');
        });
    }
}
