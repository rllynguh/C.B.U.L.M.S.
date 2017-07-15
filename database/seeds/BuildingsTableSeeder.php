<?php

use Illuminate\Database\Seeder;

class BuildingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('buildings')->delete();
        
        \DB::table('buildings')->insert(array (
            0 => 
            array (
                'id' => 13,
                'code' => 'BLDGMAL001',
                'description' => 'Menarco',
                'building_type_id' => 6,
                'num_of_floor' => 1,
                'address_id' => 35,
                'is_active' => 1,
            ),
        ));
        
        
    }
}