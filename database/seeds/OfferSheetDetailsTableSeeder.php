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
                'registration_detail_id' => 18,
                'offer_sheet_header_id' => 1,
                'unit_id' => 46,
                'status' => 1,
                'tenant_remarks' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'registration_detail_id' => 20,
                'offer_sheet_header_id' => 1,
                'unit_id' => 49,
                'status' => 1,
                'tenant_remarks' => NULL,
            ),
        ));
        
        
    }
}