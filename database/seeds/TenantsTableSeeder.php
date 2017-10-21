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
            1 => 
            array (
                'id' => 12,
                'code' => 'Tenant002',
                'description' => 'Jose\'s Pizza?',
                'business_type_id' => 1,
                'user_id' => 3,
                'address_id' => 36,
                'is_active' => 1,
            ),
            2 => 
            array (
                'id' => 13,
                'code' => 'Tenant003',
                'description' => 'hapibee',
                'business_type_id' => 1,
                'user_id' => 4,
                'address_id' => 38,
                'is_active' => 1,
            ),
            3 => 
            array (
                'id' => 14,
                'code' => 'Tenant004',
                'description' => 'MySQL Philippine Branch',
                'business_type_id' => 5,
                'user_id' => 5,
                'address_id' => 43,
                'is_active' => 1,
            ),
            4 => 
            array (
                'id' => 15,
                'code' => 'Tenant005',
                'description' => 'Montesorya Parlor For Men',
                'business_type_id' => 2,
                'user_id' => 6,
                'address_id' => 45,
                'is_active' => 1,
            ),
            5 => 
            array (
                'id' => 16,
                'code' => 'Tenant006',
                'description' => 'KFC',
                'business_type_id' => 3,
                'user_id' => 7,
                'address_id' => 47,
                'is_active' => 1,
            ),
        ));
        
        
    }
}