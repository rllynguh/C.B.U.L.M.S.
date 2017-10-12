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
                'date_issued' => '2017-10-13',
                'date_of_billing' => '2017-10-28',
                'end_of_contract' => '2019-10-14',
                'start_of_contract' => '2017-10-14',
            'pdf' => 'CONTRACT001(2017-10-13).pdf',
                'status' => 0,
            ),
            1 => 
            array (
                'id' => 2,
                'contract_header_id' => 2,
                'user_id' => 1,
                'date_issued' => '2017-10-13',
                'date_of_billing' => '2017-10-28',
                'end_of_contract' => '2019-10-14',
                'start_of_contract' => '2017-10-14',
            'pdf' => 'CONTRACT002(2017-10-13).pdf',
                'status' => 0,
            ),
        ));
        
        
    }
}