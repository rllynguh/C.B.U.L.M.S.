<?php

use Illuminate\Database\Seeder;

class ProvincesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('provinces')->delete();
        
        \DB::table('provinces')->insert(array (
            0 => 
            array (
                'id' => 1,
                'description' => 'Metro Manila',
                'is_active' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'description' => 'Tagaytay',
                'is_active' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'description' => 'Cagayan',
                'is_active' => 1,
            ),
        ));
        
        
    }
}