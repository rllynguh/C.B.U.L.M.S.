<?php

use Illuminate\Database\Seeder;

class AmendmentTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('amendment')->delete();
        
        \DB::table('amendment')->insert(array (
            0 => 
            array (
                'id' => 4,
                'code' => 'Amendment001',
                'contract_header_id' => 1,
                'user_id' => NULL,
                'duration_change' => 0,
                'status' => 0,
                'tenant_remarks' => NULL,
                'admin_remarks' => NULL,
                'created_at' => '2017-10-13 04:29:15',
                'updated_at' => '2017-10-13 04:29:15',
            ),
        ));
        
        
    }
}