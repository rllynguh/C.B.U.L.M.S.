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
                'id' => 33,
                'business_type_id' => 5,
                'requirement_id' => 1,
            ),
            1 => 
            array (
                'id' => 34,
                'business_type_id' => 5,
                'requirement_id' => 2,
            ),
            2 => 
            array (
                'id' => 35,
                'business_type_id' => 5,
                'requirement_id' => 3,
            ),
            3 => 
            array (
                'id' => 36,
                'business_type_id' => 3,
                'requirement_id' => 2,
            ),
            4 => 
            array (
                'id' => 37,
                'business_type_id' => 3,
                'requirement_id' => 3,
            ),
            5 => 
            array (
                'id' => 38,
                'business_type_id' => 1,
                'requirement_id' => 5,
            ),
            6 => 
            array (
                'id' => 39,
                'business_type_id' => 6,
                'requirement_id' => 6,
            ),
            7 => 
            array (
                'id' => 40,
                'business_type_id' => 2,
                'requirement_id' => 6,
            ),
            8 => 
            array (
                'id' => 41,
                'business_type_id' => 4,
                'requirement_id' => 3,
            ),
        ));
        
        
    }
}