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
                'last_log_at' => '2017-08-15 16:38:37',
                'remember_token' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'type' => 'tenant',
                'first_name' => 'Andres',
                'middle_name' => 'Emilio',
                'last_name' => 'Rizal',
                'email' => 'tenant@yahoo.com',
                'password' => '$2y$10$aURRoIcMEp8a6iDqv0e7KupmAGgGyFeK7MP9eo04fRav98sPieUYS',
            'cell_num' => '+1_ (___) ___-_',
                'picture' => '0508517d09fe3948829b502ea122dc28.png',
                'is_active' => 0,
                'last_log_at' => '2017-08-15 16:41:31',
                'remember_token' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'type' => 'tenant',
                'first_name' => 'Jose',
                'middle_name' => 'Fetemanaldo',
                'last_name' => 'Santiago',
                'email' => 'jose@yahoo.com',
                'password' => '$2y$10$mxi2Oaq2jr7h/dF6R4doLuYIehYJguRT4wQT9zH3mUeBUF5pBvDdO',
            'cell_num' => '+09 (121) 209-0',
                'picture' => '5d05461aaef1ced923513112096a5b7a.png',
                'is_active' => 0,
                'last_log_at' => NULL,
                'remember_token' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}