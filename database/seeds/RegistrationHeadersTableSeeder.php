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
                'id' => 1,
                'code' => 'Registration001',
                'tenant_id' => 14,
                'user_id' => 1,
                'duration_preferred' => 1,
                'date_issued' => '2017-07-27',
                'tenant_remarks' => 'myRemarks',
                'admin_remarks' => NULL,
                'status' => 1,
                'is_forfeited' => 0,
            ),
        ));
        
        
    }
}