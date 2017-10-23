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
                'pdf' => NULL,
                'is_existing_tenant' => 0,
            ),
            1 => 
            array (
                'id' => 11,
                'code' => 'Registration002',
                'tenant_id' => 13,
                'user_id' => 1,
                'duration_preferred' => 3,
                'date_issued' => '2017-10-13',
                'tenant_remarks' => 're-re-re-remarks',
                'admin_remarks' => 'go for it',
                'status' => 1,
                'is_forfeited' => 0,
            'pdf' => 'Registration002(ReservationFeeCollection).pdf',
                'is_existing_tenant' => 0,
            ),
            2 => 
            array (
                'id' => 12,
                'code' => 'Registration003',
                'tenant_id' => 13,
                'user_id' => 1,
                'duration_preferred' => 3,
                'date_issued' => '2017-10-13',
                'tenant_remarks' => '1',
                'admin_remarks' => NULL,
                'status' => 1,
                'is_forfeited' => 0,
            'pdf' => 'Registration003(ReservationFeeCollection).pdf',
                'is_existing_tenant' => 1,
            ),
            3 => 
            array (
                'id' => 13,
                'code' => 'Registration004',
                'tenant_id' => 14,
                'user_id' => NULL,
                'duration_preferred' => 3,
                'date_issued' => '2017-10-21',
                'tenant_remarks' => 'We want units now :D',
                'admin_remarks' => NULL,
                'status' => 0,
                'is_forfeited' => 0,
                'pdf' => NULL,
                'is_existing_tenant' => 0,
            ),
            4 => 
            array (
                'id' => 14,
                'code' => 'Registration005',
                'tenant_id' => 15,
                'user_id' => NULL,
                'duration_preferred' => 2,
                'date_issued' => '2017-10-21',
                'tenant_remarks' => 'I want to set up a business using your buildings',
                'admin_remarks' => NULL,
                'status' => 0,
                'is_forfeited' => 0,
                'pdf' => NULL,
                'is_existing_tenant' => 0,
            ),
            5 => 
            array (
                'id' => 15,
                'code' => 'Registration006',
                'tenant_id' => 16,
                'user_id' => NULL,
                'duration_preferred' => 2,
                'date_issued' => '2017-10-21',
                'tenant_remarks' => '12',
                'admin_remarks' => NULL,
                'status' => 0,
                'is_forfeited' => 0,
                'pdf' => NULL,
                'is_existing_tenant' => 0,
            ),
            6 => 
            array (
                'id' => 16,
                'code' => 'Registration007',
                'tenant_id' => 13,
                'user_id' => 1,
                'duration_preferred' => 1,
                'date_issued' => '2017-10-21',
                'tenant_remarks' => 'I want good units',
                'admin_remarks' => NULL,
                'status' => 1,
                'is_forfeited' => 0,
            'pdf' => 'Registration007(ReservationFeeCollection).pdf',
                'is_existing_tenant' => 1,
            ),
        ));
        
        
    }
}