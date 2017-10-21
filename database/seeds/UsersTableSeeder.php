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
                'last_log_at' => '2017-10-21 09:26:26',
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
                'last_log_at' => '2017-10-21 09:36:51',
                'remember_token' => 'NZac4LIKABa9fl0K8evZiCEfPRPHLk5MXSK7X787fa90WXb5T8PQV1dVjHsJ',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 5,
                'type' => 'tenant',
                'first_name' => 'Habadu',
                'middle_name' => 'Grillan',
                'last_name' => 'Montez',
                'email' => 'mysqlphofficial@gmail.com',
                'password' => '$2y$10$Nm6ewCQzqWfK5cP.1R0rTOSbsabgzsvHMz2LRfNGSVE7MLzuRyvtu',
            'cell_num' => '+09 (900) 551-6',
                'picture' => '0abc448fd3a819923cdc22e20c790e30.png',
                'is_active' => 0,
                'last_log_at' => NULL,
                'remember_token' => NULL,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 6,
                'type' => 'tenant',
                'first_name' => 'Porquez',
                'middle_name' => 'Maneul',
                'last_name' => 'El Lapido',
                'email' => 'ellapidlove@yahoo.com',
                'password' => '$2y$10$ilZzm1LiMRAa3udcc.zS6.oY7or85gsYDyRU9ZFgEfKMMrAFB4COq',
            'cell_num' => '+55 (254) 619-2',
                'picture' => '394f1a0ef797afae410f58e18d62a1af.jpg',
                'is_active' => 0,
                'last_log_at' => NULL,
                'remember_token' => NULL,
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 7,
                'type' => 'tenant',
                'first_name' => 'Chrystlin',
                'middle_name' => 'Agoda',
                'last_name' => 'Ramirez',
                'email' => 'emailko@yahoo.com',
                'password' => '$2y$10$Qbx6HV2XOG.mCDjpV50ZeOwcstgZfkEwth9APgK11I0JCg1uORc.W',
            'cell_num' => '+12 (910) 922-9',
                'picture' => '197a4b035bbab1a3468b1ae1eaf20dab.jpg',
                'is_active' => 0,
                'last_log_at' => NULL,
                'remember_token' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}