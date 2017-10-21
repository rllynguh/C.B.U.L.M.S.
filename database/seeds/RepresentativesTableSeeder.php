<?php

use Illuminate\Database\Seeder;

class RepresentativesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('representatives')->delete();
        
        \DB::table('representatives')->insert(array (
            0 => 
            array (
                'user_id' => 3,
                'representative_position_id' => 1,
                'tel_num' => '120102',
                'address_id' => 34,
            ),
            1 => 
            array (
                'user_id' => 4,
                'representative_position_id' => 1,
                'tel_num' => '6969',
                'address_id' => 37,
            ),
            2 => 
            array (
                'user_id' => 5,
                'representative_position_id' => 3,
                'tel_num' => '7401462',
                'address_id' => 42,
            ),
            3 => 
            array (
                'user_id' => 6,
                'representative_position_id' => 3,
                'tel_num' => '1246314',
                'address_id' => 44,
            ),
            4 => 
            array (
                'user_id' => 7,
                'representative_position_id' => 3,
                'tel_num' => '1267611',
                'address_id' => 46,
            ),
        ));
        
        
    }
}