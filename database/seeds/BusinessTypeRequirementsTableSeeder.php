<?php

use Illuminate\Database\Seeder;

class BusinessTypeRequirementsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('business_type_requirements')->delete();
        
        \DB::table('business_type_requirements')->insert(array (
            0 => 
            array (
                'id' => 1,
                'business_type_id' => 1,
                'requirement_id' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'business_type_id' => 5,
                'requirement_id' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'business_type_id' => 5,
                'requirement_id' => 2,
            ),
            3 => 
            array (
                'id' => 4,
                'business_type_id' => 5,
                'requirement_id' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'business_type_id' => 5,
                'requirement_id' => 2,
            ),
            5 => 
            array (
                'id' => 6,
                'business_type_id' => 3,
                'requirement_id' => 1,
            ),
            6 => 
            array (
                'id' => 7,
                'business_type_id' => 3,
                'requirement_id' => 3,
            ),
            7 => 
            array (
                'id' => 8,
                'business_type_id' => 3,
                'requirement_id' => 4,
            ),
            8 => 
            array (
                'id' => 9,
                'business_type_id' => 3,
                'requirement_id' => 5,
            ),
            9 => 
            array (
                'id' => 10,
                'business_type_id' => 1,
                'requirement_id' => 2,
            ),
            10 => 
            array (
                'id' => 11,
                'business_type_id' => 1,
                'requirement_id' => 3,
            ),
            11 => 
            array (
                'id' => 12,
                'business_type_id' => 1,
                'requirement_id' => 4,
            ),
            12 => 
            array (
                'id' => 13,
                'business_type_id' => 1,
                'requirement_id' => 5,
            ),
            13 => 
            array (
                'id' => 14,
                'business_type_id' => 4,
                'requirement_id' => 1,
            ),
            14 => 
            array (
                'id' => 15,
                'business_type_id' => 4,
                'requirement_id' => 2,
            ),
            15 => 
            array (
                'id' => 16,
                'business_type_id' => 4,
                'requirement_id' => 3,
            ),
            16 => 
            array (
                'id' => 17,
                'business_type_id' => 4,
                'requirement_id' => 4,
            ),
            17 => 
            array (
                'id' => 18,
                'business_type_id' => 4,
                'requirement_id' => 5,
            ),
            18 => 
            array (
                'id' => 19,
                'business_type_id' => 4,
                'requirement_id' => 6,
            ),
            19 => 
            array (
                'id' => 20,
                'business_type_id' => 2,
                'requirement_id' => 1,
            ),
            20 => 
            array (
                'id' => 21,
                'business_type_id' => 2,
                'requirement_id' => 2,
            ),
            21 => 
            array (
                'id' => 22,
                'business_type_id' => 2,
                'requirement_id' => 3,
            ),
            22 => 
            array (
                'id' => 23,
                'business_type_id' => 2,
                'requirement_id' => 5,
            ),
            23 => 
            array (
                'id' => 24,
                'business_type_id' => 2,
                'requirement_id' => 6,
            ),
            24 => 
            array (
                'id' => 25,
                'business_type_id' => 6,
                'requirement_id' => 3,
            ),
            25 => 
            array (
                'id' => 26,
                'business_type_id' => 6,
                'requirement_id' => 4,
            ),
            26 => 
            array (
                'id' => 27,
                'business_type_id' => 6,
                'requirement_id' => 5,
            ),
            27 => 
            array (
                'id' => 28,
                'business_type_id' => 1,
                'requirement_id' => 6,
            ),
            28 => 
            array (
                'id' => 29,
                'business_type_id' => 6,
                'requirement_id' => 1,
            ),
            29 => 
            array (
                'id' => 30,
                'business_type_id' => 6,
                'requirement_id' => 2,
            ),
            30 => 
            array (
                'id' => 31,
                'business_type_id' => 6,
                'requirement_id' => 6,
            ),
            31 => 
            array (
                'id' => 32,
                'business_type_id' => 2,
                'requirement_id' => 4,
            ),
        ));
        
        
    }
}