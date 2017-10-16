<?php

use Illuminate\Database\Seeder;

class PenaltiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('penalties')->delete();
        
        \DB::table('penalties')->insert(array (
            0 => 
            array (
                'id' => 1,
                'description' => 'Unable to pay on time',
                'is_active' => '0',
            ),
        ));
        
        
    }
}