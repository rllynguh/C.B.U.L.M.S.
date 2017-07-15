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
                'id' => 6,
                'description' => 'Mall',
                'is_active' => 1,
            ),
        ));
        
        
    }
}