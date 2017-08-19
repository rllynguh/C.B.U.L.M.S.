<?php

use Illuminate\Database\Seeder;

class TenantsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tenants')->delete();
        
        \DB::table('tenants')->insert(array (
            0 => 
            array (
                'id' => 11,
                'code' => 'Tenant001',
                'description' => 'Company ni Andres',
                'business_type_id' => 1,
                'user_id' => 2,
                'address_id' => 34,
                'is_active' => 1,
            ),
        ));
        
        
    }
}