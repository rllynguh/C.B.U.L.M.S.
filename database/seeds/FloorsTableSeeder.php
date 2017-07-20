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
                'num_of_unit' => 1,
                'is_active' => 1,
            ),
        ));
        
        
    }
}