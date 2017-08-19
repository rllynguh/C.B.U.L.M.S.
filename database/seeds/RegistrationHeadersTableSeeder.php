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
                'tenant_id' => 11,
                'user_id' => 1,
                'duration_preferred' => 2,
                'date_issued' => '2017-08-14',
                'tenant_remarks' => '1',
                'admin_remarks' => NULL,
                'status' => 1,
                'is_forfeited' => 0,
            ),
        ));
        
        
    }
}