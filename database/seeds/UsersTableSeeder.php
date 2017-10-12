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
                'picture' => '1.png',
                'is_active' => 1,
                'last_log_at' => '2017-10-13 02:29:28',
                'remember_token' => '81wNAkbdwiVfigaoFYrwBnHufd044sO7a43HeRz1ZiyURJD7nAim9hBBDg3D',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 3,
                'type' => 'tenant',
                'first_name' => 'Jose',
                'middle_name' => 'Fetemanaldo',
                'last_name' => 'Santiago',
                'email' => 'jose@yahoo.com',
                'password' => '$2y$10$mxi2Oaq2jr7h/dF6R4doLuYIehYJguRT4wQT9zH3mUeBUF5pBvDdO',
            'cell_num' => '+09 (121) 209-0',
                'picture' => 'jose.jpg',
                'is_active' => 0,
                'last_log_at' => '2017-09-07 00:52:08',
                'remember_token' => 'IkESaQ88am4LxgF34VwwUFgtuIi5Tpt8HUPFXsehdGri6owFIx7uoxOIf3oi',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 4,
                'type' => 'tenant',
                'first_name' => 'Kenneth',
                'middle_name' => 'Cagomoc',
                'last_name' => 'Tan',
                'email' => 'kennethtan_02@yahoo.com',
                'password' => '$2y$10$wGFDakZVfCr5XKKV/SvdB.Cl5YonOB7lYwvGcsDJyDA8xECWKaHam',
                'cell_num' => '6969',
                'picture' => '3335625be4ad5a23d6f7aa2d57be787c.png',
                'is_active' => 0,
                'last_log_at' => '2017-10-13 02:28:25',
                'remember_token' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}