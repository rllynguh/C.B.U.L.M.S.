<?php

use Illuminate\Database\Seeder;

class RegistrationDetailsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('registration_details')->delete();
        
        \DB::table('registration_details')->insert(array (
            0 => 
            array (
                'id' => 1,
                'registration_header_id' => 10,
                'amendment_id' => NULL,
                'building_type_id' => 1,
                'size_from' => 100.0,
                'size_to' => 200.0,
                'unit_type' => 0,
                'floor' => 1,
                'tenant_remarks' => 'I want good units.',
                'admin_remarks' => NULL,
                'is_rejected' => 0,
                'is_forfeited' => 0,
                'is_reserved' => 0,
                'is_amendment' => 0,
            ),
            1 => 
            array (
                'id' => 2,
                'registration_header_id' => 10,
                'amendment_id' => NULL,
                'building_type_id' => 1,
                'size_from' => 100.0,
                'size_to' => 200.0,
                'unit_type' => 1,
                'floor' => 1,
                'tenant_remarks' => 'I want something.',
                'admin_remarks' => NULL,
                'is_rejected' => 0,
                'is_forfeited' => 0,
                'is_reserved' => 0,
                'is_amendment' => 0,
            ),
            2 => 
            array (
                'id' => 3,
                'registration_header_id' => 10,
                'amendment_id' => NULL,
                'building_type_id' => 1,
                'size_from' => 100.0,
                'size_to' => 200.0,
                'unit_type' => 0,
                'floor' => 1,
                'tenant_remarks' => 'Surprise me',
                'admin_remarks' => NULL,
                'is_rejected' => 0,
                'is_forfeited' => 0,
                'is_reserved' => 0,
                'is_amendment' => 0,
            ),
            3 => 
            array (
                'id' => 4,
                'registration_header_id' => 11,
                'amendment_id' => NULL,
                'building_type_id' => 1,
                'size_from' => 100.0,
                'size_to' => 200.0,
                'unit_type' => 0,
                'floor' => 1,
                'tenant_remarks' => 'its fuckin raw',
                'admin_remarks' => NULL,
                'is_rejected' => 0,
                'is_forfeited' => 0,
                'is_reserved' => 1,
                'is_amendment' => 0,
            ),
            4 => 
            array (
                'id' => 5,
                'registration_header_id' => 11,
                'amendment_id' => NULL,
                'building_type_id' => 1,
                'size_from' => 100.0,
                'size_to' => 200.0,
                'unit_type' => 0,
                'floor' => 1,
                'tenant_remarks' => 'how long has this been here?',
                'admin_remarks' => NULL,
                'is_rejected' => 0,
                'is_forfeited' => 0,
                'is_reserved' => 1,
                'is_amendment' => 0,
            ),
            5 => 
            array (
                'id' => 6,
                'registration_header_id' => 11,
                'amendment_id' => NULL,
                'building_type_id' => 1,
                'size_from' => 100.0,
                'size_to' => 200.0,
                'unit_type' => 1,
                'floor' => 1,
                'tenant_remarks' => 'fucking shells really? come the fuck on',
                'admin_remarks' => NULL,
                'is_rejected' => 0,
                'is_forfeited' => 0,
                'is_reserved' => 1,
                'is_amendment' => 0,
            ),
            6 => 
            array (
                'id' => 7,
                'registration_header_id' => 12,
                'amendment_id' => NULL,
                'building_type_id' => 1,
                'size_from' => 100.0,
                'size_to' => 200.0,
                'unit_type' => 0,
                'floor' => 1,
                'tenant_remarks' => NULL,
                'admin_remarks' => NULL,
                'is_rejected' => 0,
                'is_forfeited' => 0,
                'is_reserved' => 1,
                'is_amendment' => 0,
            ),
            7 => 
            array (
                'id' => 8,
                'registration_header_id' => 12,
                'amendment_id' => NULL,
                'building_type_id' => 1,
                'size_from' => 100.0,
                'size_to' => 200.0,
                'unit_type' => 0,
                'floor' => 1,
                'tenant_remarks' => NULL,
                'admin_remarks' => NULL,
                'is_rejected' => 0,
                'is_forfeited' => 0,
                'is_reserved' => 1,
                'is_amendment' => 0,
            ),
            8 => 
            array (
                'id' => 10,
                'registration_header_id' => NULL,
                'amendment_id' => 4,
                'building_type_id' => 1,
                'size_from' => 100.0,
                'size_to' => 200.0,
                'unit_type' => 0,
                'floor' => 1,
                'tenant_remarks' => NULL,
                'admin_remarks' => NULL,
                'is_rejected' => 0,
                'is_forfeited' => 0,
                'is_reserved' => 0,
                'is_amendment' => 1,
            ),
            9 => 
            array (
                'id' => 11,
                'registration_header_id' => NULL,
                'amendment_id' => 4,
                'building_type_id' => 1,
                'size_from' => 100.0,
                'size_to' => 200.0,
                'unit_type' => 0,
                'floor' => 1,
                'tenant_remarks' => NULL,
                'admin_remarks' => NULL,
                'is_rejected' => 0,
                'is_forfeited' => 0,
                'is_reserved' => 0,
                'is_amendment' => 1,
            ),
        ));
        
        
    }
}