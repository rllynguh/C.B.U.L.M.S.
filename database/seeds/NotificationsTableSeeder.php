<?php

use Illuminate\Database\Seeder;

class NotificationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('notifications')->delete();
        
        \DB::table('notifications')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 4,
                'title' => 'You have received the Reservation Fee Receipt',
                'description' => 'This receipt serves as a proof of payment for the reservation fee',
                'link' => 'http://localhost:8000/tenant/docs/reservation-fee-receipt/16',
                'date_issued' => '2017-10-21',
                'date_read' => NULL,
                'is_read' => 1,
                'is_urgent' => 0,
                'type' => NULL,
                'current_contract_id' => NULL,
                'expires_on' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}