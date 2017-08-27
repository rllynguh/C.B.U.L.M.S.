<?php

use Illuminate\Database\Seeder;

class UnitsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('units')->delete();
        
        \DB::table('units')->insert(array (
            0 => 
            array (
                'id' => 1,
                'code' => 'BUI1UNIT1',
                'type' => 1,
                'size' => 120,
                'floor_id' => 1,
                'number' => 1,
                'is_active' => 1,
                'picture' => '0b04bcef6e15790faed2031eae936acc.png',
            ),
            1 => 
            array (
                'id' => 46,
                'code' => 'MY 1UNIT2',
                'type' => 0,
                'size' => 100,
                'floor_id' => 1,
                'number' => 2,
                'is_active' => 1,
                'picture' => '094b5dbe1676a19aba123071142dce3f.png',
            ),
            2 => 
            array (
                'id' => 47,
                'code' => 'MY 1UNIT3',
                'type' => 0,
                'size' => 100,
                'floor_id' => 1,
                'number' => 3,
                'is_active' => 1,
                'picture' => '89371657cce9d6b3ed2b1e3dab2dba1d.png',
            ),
            3 => 
            array (
                'id' => 48,
                'code' => 'MY 1UNIT4',
                'type' => 0,
                'size' => 105,
                'floor_id' => 1,
                'number' => 4,
                'is_active' => 1,
                'picture' => '20557b9fdfce189f6b9c12124f05b7cd.png',
            ),
            4 => 
            array (
                'id' => 49,
                'code' => 'MY 1UNIT5',
                'type' => 0,
                'size' => 100,
                'floor_id' => 1,
                'number' => 5,
                'is_active' => 1,
                'picture' => '0f78ed807532371ba22a3aecacedc560.png',
            ),
            5 => 
            array (
                'id' => 50,
                'code' => 'MY 1UNIT6',
                'type' => 0,
                'size' => 1000,
                'floor_id' => 1,
                'number' => 6,
                'is_active' => 1,
                'picture' => 'b2b30297ff6fc2390e7b370dfd45a701.png',
            ),
            6 => 
            array (
                'id' => 51,
                'code' => 'MY 1UNIT7',
                'type' => 0,
                'size' => 100,
                'floor_id' => 1,
                'number' => 7,
                'is_active' => 1,
                'picture' => '57632855471fb81178569cfc08e66b83.png',
            ),
            7 => 
            array (
                'id' => 52,
                'code' => 'MY 1UNIT8',
                'type' => 0,
                'size' => 100,
                'floor_id' => 1,
                'number' => 8,
                'is_active' => 1,
                'picture' => '115c81b8d4ed2673574a147c5b627be6.png',
            ),
            8 => 
            array (
                'id' => 53,
                'code' => 'MY 1UNIT9',
                'type' => 0,
                'size' => 101,
                'floor_id' => 1,
                'number' => 9,
                'is_active' => 1,
                'picture' => '9a14ded048d74b4472ff7697a017c252.png',
            ),
            9 => 
            array (
                'id' => 54,
                'code' => 'MY 1UNIT10',
                'type' => 0,
                'size' => 100,
                'floor_id' => 1,
                'number' => 10,
                'is_active' => 1,
                'picture' => '2ac6f8d5421ce314c8797d953a3cf642.png',
            ),
        ));
        
        
    }
}