<?php

use Illuminate\Database\Seeder;

class ParkSpacesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('park_spaces')->delete();
        
        \DB::table('park_spaces')->insert(array (
            0 => 
            array (
                'id' => 1,
                'description' => '1',
                'park_area_id' => 1,
                'number' => 1,
                'size' => 100,
                'is_active' => 1,
            ),
        ));
        
        
    }
}