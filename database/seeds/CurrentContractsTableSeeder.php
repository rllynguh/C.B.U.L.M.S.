<?php

use Illuminate\Database\Seeder;

class CurrentContractsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('current_contracts')->delete();
        
        \DB::table('current_contracts')->insert(array (
            0 => 
            array (
                'id' => 1,
                'contract_header_id' => 1,
                'user_id' => 1,
                'date_issued' => '2017-10-21',
                'date_of_billing' => '2017-12-21',
                'end_of_contract' => '2018-10-21',
                'start_of_contract' => '2017-10-21',
            'pdf' => 'CONTRACT001(2017-10-21).pdf',
                'status' => 0,
            ),
        ));
        
        
    }
}