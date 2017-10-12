<?php

use Illuminate\Database\Seeder;

class ContractContentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('contract_contents')->delete();
        
        \DB::table('contract_contents')->insert(array (
            0 => 
            array (
                'id' => 1,
                'contract_header_id' => 1,
                'content_id' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'contract_header_id' => 2,
                'content_id' => 1,
            ),
        ));
        
        
    }
}