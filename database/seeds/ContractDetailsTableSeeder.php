<?php

use Illuminate\Database\Seeder;

class ContractDetailsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('contract_details')->delete();
        
        \DB::table('contract_details')->insert(array (
            0 => 
            array (
                'id' => 1,
                'current_contract_id' => 1,
                'unit_id' => 46,
                'price' => 10000.0,
                'status' => 0,
            ),
            1 => 
            array (
                'id' => 2,
                'current_contract_id' => 1,
                'unit_id' => 49,
                'price' => 10000.0,
                'status' => 0,
            ),
        ));
        
        
    }
}