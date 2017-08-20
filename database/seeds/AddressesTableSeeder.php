<?php

use Illuminate\Database\Seeder;

class AddressesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('addresses')->delete();
        
        \DB::table('addresses')->insert(array (
            0 => 
            array (
                'id' => 1,
                'number' => '12',
                'street' => 'Sesame',
                'district' => 'Ginebra',
                'city_id' => 1,
            ),
            1 => 
            array (
                'id' => 33,
                'number' => '12',
                'street' => '2',
                'district' => '1',
                'city_id' => 1,
            ),
            2 => 
            array (
                'id' => 34,
                'number' => '12',
                'street' => '2',
                'district' => '23',
                'city_id' => 1,
            ),
        ));
        
        
    }
}