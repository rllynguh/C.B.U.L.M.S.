<?php

use Illuminate\Database\Seeder;

class BillingItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('billing_items')->delete();
        
        \DB::table('billing_items')->insert(array (
            0 => 
            array (
                'id' => 1,
                'description' => 'Rent',
                'is_active' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'description' => 'Advance Rent',
                'is_active' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'description' => 'Security Deposit',
                'is_active' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'description' => 'CUSA Fee',
                'is_active' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'description' => 'Reservation Fee',
                'is_active' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'description' => 'Vetting Fee',
                'is_active' => 1,
            ),
            6 => 
            array (
                'id' => 7,
                'description' => 'Fit-out Deposit',
                'is_active' => 1,
            ),
        ));
        
        
    }
}