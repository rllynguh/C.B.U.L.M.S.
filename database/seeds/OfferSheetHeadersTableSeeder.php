<?php

use Illuminate\Database\Seeder;

class OfferSheetHeadersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('offer_sheet_headers')->delete();
        
        \DB::table('offer_sheet_headers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'code' => 'Offer Sheet 001',
                'user_id' => 1,
                'tenant_remarks' => NULL,
                'date_issued' => '2017-10-13',
                'status' => 1,
            ),
        ));
        
        
    }
}