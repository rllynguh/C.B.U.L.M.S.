<?php

use Illuminate\Database\Seeder;

class UtilitiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('utilities')->delete();
        
        \DB::table('utilities')->insert(array (
            0 => 
            array (
                'cusa_rate' => 80,
                'reservation_fee' => 1,
                'security_deposit_rate' => 3,
                'vat_rate' => 12,
                'ewt_rate' => 1,
                'escalation_rate' => 1,
                'vetting_fee' => 100,
                'fit_out_deposit' => 1,
                'date_as_of' => '2017-08-23 00:00:00',
            ),
        ));
        
        
    }
}