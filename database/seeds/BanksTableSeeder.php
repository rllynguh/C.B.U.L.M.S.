<?php

use Illuminate\Database\Seeder;

class BanksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('banks')->delete();
        
        \DB::table('banks')->insert(array (
            0 => 
            array (
                'id' => 1,
                'description' => 'My Bank',
                'is_active' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'description' => 'BDO',
                'is_active' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'description' => 'Land Bank',
                'is_active' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'description' => 'Security  Bank',
                'is_active' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'description' => 'China Bank',
                'is_active' => 1,
            ),
        ));
        
        
    }
}