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
                'date_issued' => '2017-10-13',
                'current_contract_id' => 1,
                'cost' => 238400.0,
                'status' => 0,
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 1,
                'code' => 'BILL003',
                'date_issued' => '2017-10-13',
                'current_contract_id' => 1,
                'cost' => 60608.0,
                'status' => 0,
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 1,
                'code' => 'BILL004',
                'date_issued' => '2017-11-13',
                'current_contract_id' => 1,
                'cost' => 60608.0,
                'status' => 0,
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 1,
                'code' => 'BILL005',
                'date_issued' => '2018-01-13',
                'current_contract_id' => 1,
                'cost' => 60608.0,
                'status' => 0,
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => 1,
                'code' => 'BILL006',
                'date_issued' => '2018-04-13',
                'current_contract_id' => 1,
                'cost' => 60608.0,
                'status' => 0,
            ),
            5 => 
            array (
                'id' => 6,
                'user_id' => 1,
                'code' => 'BILL007',
                'date_issued' => '2018-08-13',
                'current_contract_id' => 1,
                'cost' => 60608.0,
                'status' => 0,
            ),
            6 => 
            array (
                'id' => 7,
                'user_id' => 1,
                'code' => 'BILL008',
                'date_issued' => '2019-01-13',
                'current_contract_id' => 1,
                'cost' => 60608.0,
                'status' => 0,
            ),
            7 => 
            array (
                'id' => 8,
                'user_id' => 1,
                'code' => 'BILL009',
                'date_issued' => '2019-07-13',
                'current_contract_id' => 1,
                'cost' => 60608.0,
                'status' => 0,
            ),
            8 => 
            array (
                'id' => 9,
                'user_id' => 1,
                'code' => 'BILL00A',
                'date_issued' => '2020-02-13',
                'current_contract_id' => 1,
                'cost' => 60608.0,
                'status' => 0,
            ),
            9 => 
            array (
                'id' => 10,
                'user_id' => 1,
                'code' => 'BILL00A001',
                'date_issued' => '2020-10-13',
                'current_contract_id' => 1,
                'cost' => 60608.0,
                'status' => 0,
            ),
            10 => 
            array (
                'id' => 11,
                'user_id' => 1,
                'code' => 'BILL00A002',
                'date_issued' => '2021-07-13',
                'current_contract_id' => 1,
                'cost' => 60608.0,
                'status' => 0,
            ),
            11 => 
            array (
                'id' => 12,
                'user_id' => 1,
                'code' => 'BILL00A003',
                'date_issued' => '2022-05-13',
                'current_contract_id' => 1,
                'cost' => 60608.0,
                'status' => 0,
            ),
            12 => 
            array (
                'id' => 13,
                'user_id' => 1,
                'code' => 'BILL00A004',
                'date_issued' => '2023-04-13',
                'current_contract_id' => 1,
                'cost' => 60608.0,
                'status' => 0,
            ),
            13 => 
            array (
                'id' => 14,
                'user_id' => 1,
                'code' => 'BILL00A005',
                'date_issued' => '2017-10-13',
                'current_contract_id' => 1,
                'cost' => 60608.0,
                'status' => 0,
            ),
            14 => 
            array (
                'id' => 15,
                'user_id' => 1,
                'code' => 'BILL00A006',
                'date_issued' => '2018-11-13',
                'current_contract_id' => 1,
                'cost' => 60608.0,
                'status' => 0,
            ),
            15 => 
            array (
                'id' => 16,
                'user_id' => 1,
                'code' => 'BILL00A007',
                'date_issued' => '2020-01-13',
                'current_contract_id' => 1,
                'cost' => 60608.0,
                'status' => 0,
            ),
            16 => 
            array (
                'id' => 17,
                'user_id' => 1,
                'code' => 'BILL00A008',
                'date_issued' => '2021-04-13',
                'current_contract_id' => 1,
                'cost' => 60608.0,
                'status' => 0,
            ),
            17 => 
            array (
                'id' => 18,
                'user_id' => 1,
                'code' => 'BILL00A009',
                'date_issued' => '2022-08-13',
                'current_contract_id' => 1,
                'cost' => 60608.0,
                'status' => 0,
            ),
            18 => 
            array (
                'id' => 19,
                'user_id' => 1,
                'code' => 'BILL00A00A',
                'date_issued' => '2024-01-13',
                'current_contract_id' => 1,
                'cost' => 60608.0,
                'status' => 0,
            ),
            19 => 
            array (
                'id' => 20,
                'user_id' => 1,
                'code' => 'BILL00A00A001',
                'date_issued' => '2025-07-13',
                'current_contract_id' => 1,
                'cost' => 60608.0,
                'status' => 0,
            ),
            20 => 
            array (
                'id' => 21,
                'user_id' => 1,
                'code' => 'BILL00A00A002',
                'date_issued' => '2027-02-13',
                'current_contract_id' => 1,
                'cost' => 60608.0,
                'status' => 0,
            ),
            21 => 
            array (
                'id' => 22,
                'user_id' => 1,
                'code' => 'BILL00A00A003',
                'date_issued' => '2028-10-13',
                'current_contract_id' => 1,
                'cost' => 60608.0,
                'status' => 0,
            ),
            22 => 
            array (
                'id' => 23,
                'user_id' => 1,
                'code' => 'BILL00A00A004',
                'date_issued' => '2030-07-13',
                'current_contract_id' => 1,
                'cost' => 60608.0,
                'status' => 0,
            ),
            23 => 
            array (
                'id' => 24,
                'user_id' => 1,
                'code' => 'BILL00A00A005',
                'date_issued' => '2032-05-13',
                'current_contract_id' => 1,
                'cost' => 60608.0,
                'status' => 0,
            ),
            24 => 
            array (
                'id' => 25,
                'user_id' => 1,
                'code' => 'BILL00A00A006',
                'date_issued' => '2034-04-13',
                'current_contract_id' => 1,
                'cost' => 60608.0,
                'status' => 0,
            ),
        ));
        
        
    }
}