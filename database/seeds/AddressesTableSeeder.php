<?php

use Illuminate\Database\Seeder;

class AddressesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('addresses')->delete();
        
        \DB::table('addresses')->insert(array (
            0 => 
            array (
                'id' => 1,
                'number' => '12',
                'street' => 'Sesame',
                'district' => 'Ginebra',
                'city_id' => 1,
            ),
            1 => 
            array (
                'id' => 33,
                'number' => '12',
                'street' => '2',
                'district' => '1',
                'city_id' => 1,
            ),
            2 => 
            array (
                'id' => 34,
                'number' => '12',
                'street' => '2',
                'district' => '23',
                'city_id' => 1,
            ),
            3 => 
            array (
                'id' => 35,
                'number' => '12',
                'street' => 'San Antonio',
                'district' => 'Masaya',
                'city_id' => 1,
            ),
            4 => 
            array (
                'id' => 36,
                'number' => '23',
                'street' => 'San Andres',
                'district' => 'Maligaya',
                'city_id' => 1,
            ),
            5 => 
            array (
                'id' => 37,
                'number' => '6969',
                'street' => '6969',
                'district' => '6969',
                'city_id' => 1,
            ),
            6 => 
            array (
                'id' => 38,
                'number' => '6969',
                'street' => '6969',
                'district' => '6969',
                'city_id' => 1,
            ),
            7 => 
            array (
                'id' => 39,
                'number' => '1234',
                'street' => 'Masarap',
                'district' => 'Mabuhay',
                'city_id' => 1,
            ),
            8 => 
            array (
                'id' => 40,
                'number' => '8700',
                'street' => 'jalibi',
                'district' => 'delivery',
                'city_id' => 2,
            ),
            9 => 
            array (
                'id' => 41,
                'number' => '4020',
                'street' => 'Yummy',
                'district' => 'Masarap',
                'city_id' => 4,
            ),
            10 => 
            array (
                'id' => 42,
                'number' => '1341',
                'street' => 'Refreshing',
                'district' => 'Breezy',
                'city_id' => 3,
            ),
            11 => 
            array (
                'id' => 43,
                'number' => '113',
                'street' => 'Mabuhay',
                'district' => 'Saraha',
                'city_id' => 3,
            ),
            12 => 
            array (
                'id' => 44,
                'number' => '417',
                'street' => 'Harmonez',
                'district' => 'Kalabush',
                'city_id' => 3,
            ),
            13 => 
            array (
                'id' => 45,
                'number' => '6969',
                'street' => 'Alabama',
                'district' => 'Macho',
                'city_id' => 3,
            ),
            14 => 
            array (
                'id' => 46,
                'number' => '43',
                'street' => 'Malunggay',
                'district' => 'Mabuhay',
                'city_id' => 3,
            ),
            15 => 
            array (
                'id' => 47,
                'number' => '1211',
                'street' => 'Sesame',
                'district' => 'Ginebra',
                'city_id' => 3,
            ),
        ));
        
        
    }
}