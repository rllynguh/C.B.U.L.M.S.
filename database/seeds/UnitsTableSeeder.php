<?php

use Illuminate\Database\Seeder;

class UnitsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('units')->delete();
        
        \DB::table('units')->insert(array (
            0 => 
            array (
                'id' => 1,
                'code' => 'MY 1UNIT1',
                'type' => 1,
                'size' => 100,
                'floor_id' => 1,
                'number' => 1,
                'is_active' => 1,
                'picture' => '2b6ab4d172e750bea8cf48d7282748fapng',
            ),
            1 => 
            array (
                'id' => 46,
                'code' => 'MY 2UNIT1',
                'type' => 0,
                'size' => 100,
                'floor_id' => 38,
                'number' => 1,
                'is_active' => 1,
                'picture' => NULL,
            ),
            2 => 
            array (
                'id' => 47,
                'code' => 'MY 3UNIT1',
                'type' => 0,
                'size' => 100,
                'floor_id' => 39,
                'number' => 1,
                'is_active' => 1,
                'picture' => NULL,
            ),
            3 => 
            array (
                'id' => 48,
                'code' => 'MY 3UNIT2',
                'type' => 1,
                'size' => 100,
                'floor_id' => 39,
                'number' => 2,
                'is_active' => 1,
                'picture' => NULL,
            ),
        ));
        
        
    }
}