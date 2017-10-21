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
                'id' => 1,
                'code' => 'BLDGMAL001',
                'description' => 'My Building',
                'building_type_id' => 1,
                'num_of_floor' => 1,
                'address_id' => 1,
                'is_active' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'code' => 'BLDGAPA001',
                'description' => 'CondoTel',
                'building_type_id' => 3,
                'num_of_floor' => 12,
                'address_id' => 39,
                'is_active' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'code' => 'BLDGRES001',
                'description' => 'McDo',
                'building_type_id' => 2,
                'num_of_floor' => 3,
                'address_id' => 40,
                'is_active' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'code' => 'BLDGBUI001',
                'description' => 'Plaza Hut',
                'building_type_id' => 6,
                'num_of_floor' => 12,
                'address_id' => 41,
                'is_active' => 1,
            ),
        ));
        
        
    }
}