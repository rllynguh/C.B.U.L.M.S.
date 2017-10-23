<?php

use Illuminate\Database\Seeder;

class ContractHeadersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('contract_headers')->delete();
        
        \DB::table('contract_headers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'registration_header_id' => 16,
                'code' => 'CONTRACT001',
                'escalation_rate' => 1.0,
                'status' => 0,
            ),
        ));
        
        
    }
}