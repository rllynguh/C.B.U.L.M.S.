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
        ));
        
        
    }
}