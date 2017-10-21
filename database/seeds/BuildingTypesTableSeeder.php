<?php

use Illuminate\Database\Seeder;

class BuildingTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('building_types')->delete();
        
        \DB::table('building_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'description' => 'Mall',
                'is_active' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'description' => 'Restaurant',
                'is_active' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'description' => 'Apartment Complex',
                'is_active' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'description' => 'Castle',
                'is_active' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'description' => 'School',
                'is_active' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'description' => 'Building Plaza',
                'is_active' => 1,
            ),
        ));
        
        
    }
}