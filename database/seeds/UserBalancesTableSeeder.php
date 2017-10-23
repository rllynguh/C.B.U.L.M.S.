<?php

use Illuminate\Database\Seeder;

class UserBalancesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_balances')->delete();
        
        \DB::table('user_balances')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 5,
                'date_as_of' => '2017-10-21',
                'payment_id' => 0,
                'balance' => 0.0,
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 6,
                'date_as_of' => '2017-10-21',
                'payment_id' => 0,
                'balance' => 0.0,
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 7,
                'date_as_of' => '2017-10-21',
                'payment_id' => 0,
                'balance' => 0.0,
            ),
        ));
        
        
    }
}