<?php

use Illuminate\Database\Seeder;

class BusinessTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('business_types')->delete();
        
        \DB::table('business_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'description' => 'Food Service',
                'is_active' => 1,
            ),
        ));
        
        
    }
}