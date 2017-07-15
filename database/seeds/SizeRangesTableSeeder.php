<?php

use Illuminate\Database\Seeder;

class SizeRangesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('size_ranges')->delete();
        
        \DB::table('size_ranges')->insert(array (
            0 => 
            array (
                'id' => 1,
                'size_from' => 100,
                'size_to' => 2000,
                'is_active' => 1,
            ),
        ));
        
        
    }
}