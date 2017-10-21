<?php

use Illuminate\Database\Seeder;

class RequirementsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('requirements')->delete();
        
        \DB::table('requirements')->insert(array (
            0 => 
            array (
                'id' => 1,
                'description' => 'Architectural layout',
                'is_active' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'description' => 'Simple Plan',
                'is_active' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'description' => 'Valid ID',
                'is_active' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'description' => 'BIR Form',
                'is_active' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'description' => 'Business Permit',
                'is_active' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'description' => 'Sanitary Check',
                'is_active' => 1,
            ),
        ));
        
        
    }
}