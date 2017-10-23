<?php

use Illuminate\Database\Seeder;

class UnitPricesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('unit_prices')->delete();
        
        \DB::table('unit_prices')->insert(array (
            0 => 
            array (
                'unit_id' => 1,
                'date_as_of' => '2017-08-04 20:40:51',
                'price' => 100.0,
            ),
            1 => 
            array (
                'unit_id' => 46,
                'date_as_of' => '2017-08-21 18:55:50',
                'price' => 100.11,
            ),
            2 => 
            array (
                'unit_id' => 47,
                'date_as_of' => '2017-08-21 18:56:10',
                'price' => 100.21,
            ),
            3 => 
            array (
                'unit_id' => 48,
                'date_as_of' => '2017-08-21 18:56:41',
                'price' => 100.21,
            ),
            4 => 
            array (
                'unit_id' => 49,
                'date_as_of' => '2017-08-21 18:56:50',
                'price' => 100.21,
            ),
            5 => 
            array (
                'unit_id' => 50,
                'date_as_of' => '2017-08-21 18:58:35',
                'price' => 122.0,
            ),
            6 => 
            array (
                'unit_id' => 51,
                'date_as_of' => '2017-08-21 18:59:17',
                'price' => 122.0,
            ),
            7 => 
            array (
                'unit_id' => 52,
                'date_as_of' => '2017-08-21 19:00:12',
                'price' => 100.0,
            ),
            8 => 
            array (
                'unit_id' => 1,
                'date_as_of' => '2017-08-21 19:04:56',
                'price' => 100.0,
            ),
            9 => 
            array (
                'unit_id' => 46,
                'date_as_of' => '2017-08-21 19:04:56',
                'price' => 100.0,
            ),
            10 => 
            array (
                'unit_id' => 47,
                'date_as_of' => '2017-08-21 19:04:56',
                'price' => 100.0,
            ),
            11 => 
            array (
                'unit_id' => 48,
                'date_as_of' => '2017-08-21 19:04:57',
                'price' => 100.0,
            ),
            12 => 
            array (
                'unit_id' => 49,
                'date_as_of' => '2017-08-21 19:04:57',
                'price' => 100.0,
            ),
            13 => 
            array (
                'unit_id' => 50,
                'date_as_of' => '2017-08-21 19:04:57',
                'price' => 100.0,
            ),
            14 => 
            array (
                'unit_id' => 51,
                'date_as_of' => '2017-08-21 19:04:57',
                'price' => 100.0,
            ),
            15 => 
            array (
                'unit_id' => 52,
                'date_as_of' => '2017-08-21 19:04:57',
                'price' => 100.0,
            ),
            16 => 
            array (
                'unit_id' => 53,
                'date_as_of' => '2017-08-21 19:06:22',
                'price' => 102.0,
            ),
            17 => 
            array (
                'unit_id' => 54,
                'date_as_of' => '2017-08-21 19:07:13',
                'price' => 101.0,
            ),
            18 => 
            array (
                'unit_id' => 55,
                'date_as_of' => '2017-10-21 08:58:54',
                'price' => 122.0,
            ),
            19 => 
            array (
                'unit_id' => 56,
                'date_as_of' => '2017-10-21 08:59:12',
                'price' => 122.0,
            ),
            20 => 
            array (
                'unit_id' => 57,
                'date_as_of' => '2017-10-21 08:59:27',
                'price' => 300.0,
            ),
            21 => 
            array (
                'unit_id' => 58,
                'date_as_of' => '2017-10-21 08:59:44',
                'price' => 300.0,
            ),
            22 => 
            array (
                'unit_id' => 59,
                'date_as_of' => '2017-10-21 09:00:01',
                'price' => 123.0,
            ),
            23 => 
            array (
                'unit_id' => 60,
                'date_as_of' => '2017-10-21 09:00:15',
                'price' => 123.0,
            ),
            24 => 
            array (
                'unit_id' => 61,
                'date_as_of' => '2017-10-21 09:00:30',
                'price' => 123.0,
            ),
            25 => 
            array (
                'unit_id' => 62,
                'date_as_of' => '2017-10-21 09:00:51',
                'price' => 123.0,
            ),
            26 => 
            array (
                'unit_id' => 63,
                'date_as_of' => '2017-10-21 09:01:02',
                'price' => 123.0,
            ),
            27 => 
            array (
                'unit_id' => 64,
                'date_as_of' => '2017-10-21 09:01:21',
                'price' => 111.94,
            ),
            28 => 
            array (
                'unit_id' => 65,
                'date_as_of' => '2017-10-21 09:01:36',
                'price' => 111.94,
            ),
            29 => 
            array (
                'unit_id' => 66,
                'date_as_of' => '2017-10-21 09:01:42',
                'price' => 111.94,
            ),
            30 => 
            array (
                'unit_id' => 67,
                'date_as_of' => '2017-10-21 09:02:03',
                'price' => 300.0,
            ),
            31 => 
            array (
                'unit_id' => 68,
                'date_as_of' => '2017-10-21 09:02:21',
                'price' => 150.0,
            ),
            32 => 
            array (
                'unit_id' => 69,
                'date_as_of' => '2017-10-21 09:02:31',
                'price' => 150.0,
            ),
            33 => 
            array (
                'unit_id' => 70,
                'date_as_of' => '2017-10-21 09:02:53',
                'price' => 112.0,
            ),
            34 => 
            array (
                'unit_id' => 71,
                'date_as_of' => '2017-10-21 09:03:07',
                'price' => 311.0,
            ),
            35 => 
            array (
                'unit_id' => 72,
                'date_as_of' => '2017-10-21 09:03:18',
                'price' => 311.0,
            ),
            36 => 
            array (
                'unit_id' => 73,
                'date_as_of' => '2017-10-21 09:03:26',
                'price' => 311.0,
            ),
        ));
        
        
    }
}