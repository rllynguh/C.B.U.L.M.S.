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
                'number' => '123',
                'street' => 'MyStreet',
                'district' => 'Malunggay',
                'city_id' => 1,
            ),
        ));
        
        
    }
}