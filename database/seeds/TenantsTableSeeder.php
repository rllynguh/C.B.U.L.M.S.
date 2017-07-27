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
                'id' => 1,
                'code' => 'Tenant001',
                'description' => 'Jose\'s Bakery',
                'business_type_id' => 1,
                'user_id' => 1,
                'address_id' => 1,
                'is_active' => 1,
            ),
        ));
        
        
    }
}