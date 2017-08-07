<?php

use Illuminate\Database\Seeder;

class ParkAreasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('park_areas')->delete();
        
        \DB::table('park_areas')->insert(array (
            0 => 
            array (
                'id' => 1,
                'description' => 'PA1-12',
                'floor_id' => 1,
                'num_of_space' => 12,
                'size' => 1200,
                'is_active' => 1,
            ),
        ));
        
        
    }
}