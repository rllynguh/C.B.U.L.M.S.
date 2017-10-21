<?php

use Illuminate\Database\Seeder;

class BillingHeadersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('billing_headers')->delete();
        
        \DB::table('billing_headers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 1,
                'code' => 'BILL002',
                'date_issued' => '2017-12-21',
                'current_contract_id' => 1,
                'cost' => 149000.0,
                'status' => 0,
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 1,
                'code' => 'BILL003',
                'date_issued' => '2017-12-21',
                'current_contract_id' => 1,
                'cost' => 37880.0,
                'status' => 0,
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 1,
                'code' => 'BILL004',
                'date_issued' => '2018-01-21',
                'current_contract_id' => 1,
                'cost' => 37880.0,
                'status' => 0,
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 1,
                'code' => 'BILL005',
                'date_issued' => '2018-02-21',
                'current_contract_id' => 1,
                'cost' => 37880.0,
                'status' => 0,
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => 1,
                'code' => 'BILL006',
                'date_issued' => '2018-03-21',
                'current_contract_id' => 1,
                'cost' => 37880.0,
                'status' => 0,
            ),
            5 => 
            array (
                'id' => 6,
                'user_id' => 1,
                'code' => 'BILL007',
                'date_issued' => '2018-04-21',
                'current_contract_id' => 1,
                'cost' => 37880.0,
                'status' => 0,
            ),
            6 => 
            array (
                'id' => 7,
                'user_id' => 1,
                'code' => 'BILL008',
                'date_issued' => '2018-05-21',
                'current_contract_id' => 1,
                'cost' => 37880.0,
                'status' => 0,
            ),
            7 => 
            array (
                'id' => 8,
                'user_id' => 1,
                'code' => 'BILL009',
                'date_issued' => '2018-06-21',
                'current_contract_id' => 1,
                'cost' => 37880.0,
                'status' => 0,
            ),
            8 => 
            array (
                'id' => 9,
                'user_id' => 1,
                'code' => 'BILL00A',
                'date_issued' => '2018-07-21',
                'current_contract_id' => 1,
                'cost' => 37880.0,
                'status' => 0,
            ),
            9 => 
            array (
                'id' => 10,
                'user_id' => 1,
                'code' => 'BILL00A001',
                'date_issued' => '2018-08-21',
                'current_contract_id' => 1,
                'cost' => 37880.0,
                'status' => 0,
            ),
            10 => 
            array (
                'id' => 11,
                'user_id' => 1,
                'code' => 'BILL00A002',
                'date_issued' => '2018-09-21',
                'current_contract_id' => 1,
                'cost' => 37880.0,
                'status' => 0,
            ),
            11 => 
            array (
                'id' => 12,
                'user_id' => 1,
                'code' => 'BILL00A003',
                'date_issued' => '2018-10-21',
                'current_contract_id' => 1,
                'cost' => 37880.0,
                'status' => 0,
            ),
            12 => 
            array (
                'id' => 13,
                'user_id' => 1,
                'code' => 'BILL00A004',
                'date_issued' => '2018-11-21',
                'current_contract_id' => 1,
                'cost' => 37880.0,
                'status' => 0,
            ),
        ));
        
        
    }
}