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
                'rate' => 1000,
                'date_as_of' => '2017-08-10 00:00:00',
            ),
        ));
        
        
    }
}