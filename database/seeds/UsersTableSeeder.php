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
                'email' => 'myemail@yahoo.com',
                'password' => '$2y$10$8UTTwaHw7SKOff1dA1W/nusQKV7R.l9pAuaKwoi2UlgU.jcY4WjeW',
                'cell_num' => '12',
                'picture' => NULL,
                'is_active' => 1,
                'last_log_at' => '2017-07-23 06:49:16',
                'remember_token' => 'mFFB0cH8gNzMpe9Te5GVfGcYfZthYbJc76OCLbKgjqGCq83IZv9FkfxMvLyt',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}