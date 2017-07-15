<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 3,
                'type' => 'admin',
                'first_name' => 'Christopher',
                'middle_name' => 'Ramos',
                'last_name' => 'Atienza',
                'email' => 'toffy@yahoo.com',
                'password' => '$2y$10$Y5z3Dtk4roAr/KhpSaOwhubFnWA80EVXqX8dbZDw2rvZOSYATFRaG',
                'cell_num' => '09123456789',
                'picture' => NULL,
                'is_active' => 1,
                'last_log_at' => '2017-07-15 16:06:11',
                'remember_token' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}