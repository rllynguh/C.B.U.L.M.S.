<?php

use Illuminate\Database\Seeder;

class RegistrationRequirementsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('registration_requirements')->delete();
        
        \DB::table('registration_requirements')->insert(array (
            0 => 
            array (
                'id' => 1,
                'registration_header_id' => 10,
                'requirement_id' => 1,
                'is_fulfilled' => 0,
            ),
            1 => 
            array (
                'id' => 2,
                'registration_header_id' => 11,
                'requirement_id' => 1,
                'is_fulfilled' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'registration_header_id' => 12,
                'requirement_id' => 1,
                'is_fulfilled' => 1,
            ),
        ));
        
        
    }
}