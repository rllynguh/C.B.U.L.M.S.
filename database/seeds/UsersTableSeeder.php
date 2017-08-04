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
                'id' => 1,
                'type' => 'admin',
                'first_name' => 'Christopher',
                'middle_name' => 'Ramos',
                'last_name' => 'Atienza',
                'email' => 'admin@yahoo.com',
                'password' => '$2y$10$7rOSKruyYujSXhyvpE6O3.T84j0uxSnfmDfRLmJBfVp9zeHJs5xom',
                'cell_num' => '12121212121',
                'picture' => NULL,
                'is_active' => 1,
                'last_log_at' => '2017-08-04 20:30:02',
                'remember_token' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}