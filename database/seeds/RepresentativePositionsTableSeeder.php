<?php

use Illuminate\Database\Seeder;

class RepresentativePositionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('representative_positions')->delete();
        
        \DB::table('representative_positions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'description' => 'Manager',
                'is_active' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'description' => 'Supervisor',
                'is_active' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'description' => 'Company CEO',
                'is_active' => 1,
            ),
        ));
        
        
    }
}