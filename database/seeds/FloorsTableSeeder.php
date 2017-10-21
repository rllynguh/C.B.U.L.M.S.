<?php

use Illuminate\Database\Seeder;

class FloorsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('floors')->delete();
        
        \DB::table('floors')->insert(array (
            0 => 
            array (
                'id' => 1,
                'building_id' => 1,
                'number' => 1,
                'num_of_unit' => 10,
                'is_active' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'building_id' => 3,
                'number' => 1,
                'num_of_unit' => 3,
                'is_active' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'building_id' => 3,
                'number' => 2,
                'num_of_unit' => 4,
                'is_active' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'building_id' => 3,
                'number' => 3,
                'num_of_unit' => 5,
                'is_active' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'building_id' => 2,
                'number' => 1,
                'num_of_unit' => 12,
                'is_active' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'building_id' => 2,
                'number' => 2,
                'num_of_unit' => 31,
                'is_active' => 1,
            ),
            6 => 
            array (
                'id' => 7,
                'building_id' => 2,
                'number' => 3,
                'num_of_unit' => 17,
                'is_active' => 1,
            ),
            7 => 
            array (
                'id' => 8,
                'building_id' => 2,
                'number' => 4,
                'num_of_unit' => 9,
                'is_active' => 1,
            ),
            8 => 
            array (
                'id' => 9,
                'building_id' => 4,
                'number' => 1,
                'num_of_unit' => 12,
                'is_active' => 1,
            ),
            9 => 
            array (
                'id' => 10,
                'building_id' => 4,
                'number' => 2,
                'num_of_unit' => 10,
                'is_active' => 1,
            ),
            10 => 
            array (
                'id' => 11,
                'building_id' => 4,
                'number' => 3,
                'num_of_unit' => 6,
                'is_active' => 1,
            ),
        ));
        
        
    }
}