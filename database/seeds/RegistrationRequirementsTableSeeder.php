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
            3 => 
            array (
                'id' => 4,
                'registration_header_id' => 13,
                'requirement_id' => 1,
                'is_fulfilled' => 0,
            ),
            4 => 
            array (
                'id' => 5,
                'registration_header_id' => 13,
                'requirement_id' => 1,
                'is_fulfilled' => 0,
            ),
            5 => 
            array (
                'id' => 6,
                'registration_header_id' => 13,
                'requirement_id' => 2,
                'is_fulfilled' => 0,
            ),
            6 => 
            array (
                'id' => 7,
                'registration_header_id' => 13,
                'requirement_id' => 2,
                'is_fulfilled' => 0,
            ),
            7 => 
            array (
                'id' => 8,
                'registration_header_id' => 14,
                'requirement_id' => 1,
                'is_fulfilled' => 0,
            ),
            8 => 
            array (
                'id' => 9,
                'registration_header_id' => 14,
                'requirement_id' => 2,
                'is_fulfilled' => 0,
            ),
            9 => 
            array (
                'id' => 10,
                'registration_header_id' => 14,
                'requirement_id' => 3,
                'is_fulfilled' => 0,
            ),
            10 => 
            array (
                'id' => 11,
                'registration_header_id' => 14,
                'requirement_id' => 4,
                'is_fulfilled' => 0,
            ),
            11 => 
            array (
                'id' => 12,
                'registration_header_id' => 14,
                'requirement_id' => 5,
                'is_fulfilled' => 0,
            ),
            12 => 
            array (
                'id' => 13,
                'registration_header_id' => 14,
                'requirement_id' => 6,
                'is_fulfilled' => 0,
            ),
            13 => 
            array (
                'id' => 14,
                'registration_header_id' => 15,
                'requirement_id' => 1,
                'is_fulfilled' => 0,
            ),
            14 => 
            array (
                'id' => 15,
                'registration_header_id' => 15,
                'requirement_id' => 3,
                'is_fulfilled' => 0,
            ),
            15 => 
            array (
                'id' => 16,
                'registration_header_id' => 15,
                'requirement_id' => 4,
                'is_fulfilled' => 0,
            ),
            16 => 
            array (
                'id' => 17,
                'registration_header_id' => 15,
                'requirement_id' => 5,
                'is_fulfilled' => 0,
            ),
            17 => 
            array (
                'id' => 18,
                'registration_header_id' => 16,
                'requirement_id' => 1,
                'is_fulfilled' => 1,
            ),
            18 => 
            array (
                'id' => 19,
                'registration_header_id' => 16,
                'requirement_id' => 2,
                'is_fulfilled' => 1,
            ),
            19 => 
            array (
                'id' => 20,
                'registration_header_id' => 16,
                'requirement_id' => 3,
                'is_fulfilled' => 1,
            ),
            20 => 
            array (
                'id' => 21,
                'registration_header_id' => 16,
                'requirement_id' => 4,
                'is_fulfilled' => 1,
            ),
            21 => 
            array (
                'id' => 22,
                'registration_header_id' => 16,
                'requirement_id' => 5,
                'is_fulfilled' => 1,
            ),
            22 => 
            array (
                'id' => 23,
                'registration_header_id' => 16,
                'requirement_id' => 6,
                'is_fulfilled' => 1,
            ),
        ));
        
        
    }
}