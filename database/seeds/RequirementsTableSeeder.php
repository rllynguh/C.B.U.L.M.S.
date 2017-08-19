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
        ));
        
        
    }
}