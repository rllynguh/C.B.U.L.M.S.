<?php

use Illuminate\Database\Seeder;

class RegistrationHeadersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('registration_headers')->delete();
        
        \DB::table('registration_headers')->insert(array (
            0 => 
            array (
                'id' => 10,
                'code' => 'Registration001',
                'tenant_id' => 12,
                'user_id' => NULL,
                'duration_preferred' => 1,
                'date_issued' => '2017-08-21',
                'tenant_remarks' => 'Remarkls',
                'admin_remarks' => NULL,
                'status' => 0,
                'is_forfeited' => 0,
            ),
        ));
        
        
    }
}