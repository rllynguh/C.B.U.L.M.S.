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
                'cusa_rate' => 80.0,
                'reservation_fee' => 1.0,
                'security_deposit_rate' => 3,
                'advance_rent_rate' => 3,
                'vat_rate' => 12.0,
                'ewt_rate' => 1.0,
                'escalation_rate' => 1.0,
                'vetting_fee' => 100.0,
                'fit_out_deposit' => 1.0,
                'for_interest_days' => 60,
                'billing_day' => 6,
                'delayed_interest' => 1.0,
                'date_as_of' => '2017-08-23 00:00:00',
                'days_before_termination' => 60,
            ),
        ));
        
        
    }
}