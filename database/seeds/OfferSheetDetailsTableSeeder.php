<?php

use Illuminate\Database\Seeder;

class OfferSheetDetailsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('offer_sheet_details')->delete();
        
        \DB::table('offer_sheet_details')->insert(array (
            0 => 
            array (
                'id' => 1,
                'registration_detail_id' => 4,
                'offer_sheet_header_id' => 1,
                'unit_id' => 46,
                'status' => 1,
                'tenant_remarks' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'registration_detail_id' => 5,
                'offer_sheet_header_id' => 1,
                'unit_id' => 49,
                'status' => 1,
                'tenant_remarks' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'registration_detail_id' => 6,
                'offer_sheet_header_id' => 1,
                'unit_id' => 1,
                'status' => 1,
                'tenant_remarks' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'registration_detail_id' => 7,
                'offer_sheet_header_id' => 2,
                'unit_id' => 47,
                'status' => 1,
                'tenant_remarks' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'registration_detail_id' => 8,
                'offer_sheet_header_id' => 2,
                'unit_id' => 52,
                'status' => 1,
                'tenant_remarks' => NULL,
            ),
        ));
        
        
    }
}