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
                'price' => 100,
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
                'price' => 100.20999999999999,
            ),
            3 => 
            array (
                'unit_id' => 48,
                'date_as_of' => '2017-08-21 18:56:41',
                'price' => 100.20999999999999,
            ),
            4 => 
            array (
                'unit_id' => 49,
                'date_as_of' => '2017-08-21 18:56:50',
                'price' => 100.20999999999999,
            ),
            5 => 
            array (
                'unit_id' => 50,
                'date_as_of' => '2017-08-21 18:58:35',
                'price' => 122,
            ),
            6 => 
            array (
                'unit_id' => 51,
                'date_as_of' => '2017-08-21 18:59:17',
                'price' => 122,
            ),
            7 => 
            array (
                'unit_id' => 52,
                'date_as_of' => '2017-08-21 19:00:12',
                'price' => 100,
            ),
            8 => 
            array (
                'unit_id' => 1,
                'date_as_of' => '2017-08-21 19:04:56',
                'price' => 100,
            ),
            9 => 
            array (
                'unit_id' => 46,
                'date_as_of' => '2017-08-21 19:04:56',
                'price' => 100,
            ),
            10 => 
            array (
                'unit_id' => 47,
                'date_as_of' => '2017-08-21 19:04:56',
                'price' => 100,
            ),
            11 => 
            array (
                'unit_id' => 48,
                'date_as_of' => '2017-08-21 19:04:57',
                'price' => 100,
            ),
            12 => 
            array (
                'unit_id' => 49,
                'date_as_of' => '2017-08-21 19:04:57',
                'price' => 100,
            ),
            13 => 
            array (
                'unit_id' => 50,
                'date_as_of' => '2017-08-21 19:04:57',
                'price' => 100,
            ),
            14 => 
            array (
                'unit_id' => 51,
                'date_as_of' => '2017-08-21 19:04:57',
                'price' => 100,
            ),
            15 => 
            array (
                'unit_id' => 52,
                'date_as_of' => '2017-08-21 19:04:57',
                'price' => 100,
            ),
            16 => 
            array (
                'unit_id' => 53,
                'date_as_of' => '2017-08-21 19:06:22',
                'price' => 102,
            ),
            17 => 
            array (
                'unit_id' => 54,
                'date_as_of' => '2017-08-21 19:07:13',
                'price' => 101,
            ),
        ));
        
        
    }
}