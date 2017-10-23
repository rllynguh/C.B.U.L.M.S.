<?php

use Illuminate\Database\Seeder;

class BusinessTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('business_types')->delete();
        
        \DB::table('business_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'description' => 'Food Service',
                'is_active' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'description' => 'Massage',
                'is_active' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'description' => 'Food and Beverages',
                'is_active' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'description' => 'Parlor',
                'is_active' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'description' => 'Electronics',
                'is_active' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'description' => 'Gym',
                'is_active' => 1,
            ),
        ));
        
        
    }
}