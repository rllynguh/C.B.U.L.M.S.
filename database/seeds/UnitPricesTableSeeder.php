<?php

use Illuminate\Database\Seeder;

class UnitPricesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('unit_prices')->delete();
        
        \DB::table('unit_prices')->insert(array (
            0 => 
            array (
                'unit_id' => 1,
                'date_as_of' => '2017-08-04 20:40:51',
                'price' => 100,
            ),
        ));
        
        
    }
}