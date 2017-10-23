<?php

use Illuminate\Database\Seeder;

class MarketRatesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('market_rates')->delete();
        
        \DB::table('market_rates')->insert(array (
            0 => 
            array (
                'city_id' => 1,
                'rate' => 1000.0,
                'date_as_of' => '2017-08-10 00:00:00',
            ),
            1 => 
            array (
                'city_id' => 2,
                'rate' => 1000.0,
                'date_as_of' => '2017-10-21 09:04:00',
            ),
            2 => 
            array (
                'city_id' => 3,
                'rate' => 671.0,
                'date_as_of' => '2017-10-21 09:04:06',
            ),
            3 => 
            array (
                'city_id' => 4,
                'rate' => 704.0,
                'date_as_of' => '2017-10-21 09:04:12',
            ),
        ));
        
        
    }
}