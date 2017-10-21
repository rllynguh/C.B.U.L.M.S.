<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cities')->delete();
        
        \DB::table('cities')->insert(array (
            0 => 
            array (
                'id' => 1,
                'description' => 'Taguig',
                'province_id' => 1,
                'is_active' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'description' => 'Cebu',
                'province_id' => 1,
                'is_active' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'description' => 'Delmonte',
                'province_id' => 3,
                'is_active' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'description' => 'Tagaytay',
                'province_id' => 2,
                'is_active' => 1,
            ),
        ));
        
        
    }
}