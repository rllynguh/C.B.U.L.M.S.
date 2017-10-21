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
                'size' => 120.0,
                'floor_id' => 1,
                'number' => 1,
                'is_active' => 1,
                'picture' => '0b04bcef6e15790faed2031eae936acc.png',
            ),
            1 => 
            array (
                'id' => 46,
                'code' => 'MY1UNIT2',
                'type' => 0,
                'size' => 100.0,
                'floor_id' => 1,
                'number' => 2,
                'is_active' => 1,
                'picture' => '094b5dbe1676a19aba123071142dce3f.png',
            ),
            2 => 
            array (
                'id' => 47,
                'code' => 'MY1UNIT3',
                'type' => 0,
                'size' => 100.0,
                'floor_id' => 1,
                'number' => 3,
                'is_active' => 1,
                'picture' => '89371657cce9d6b3ed2b1e3dab2dba1d.png',
            ),
            3 => 
            array (
                'id' => 48,
                'code' => 'MY1UNIT4',
                'type' => 0,
                'size' => 105.0,
                'floor_id' => 1,
                'number' => 4,
                'is_active' => 1,
                'picture' => '20557b9fdfce189f6b9c12124f05b7cd.png',
            ),
            4 => 
            array (
                'id' => 49,
                'code' => 'MY1UNIT5',
                'type' => 0,
                'size' => 100.0,
                'floor_id' => 1,
                'number' => 5,
                'is_active' => 1,
                'picture' => '0f78ed807532371ba22a3aecacedc560.png',
            ),
            5 => 
            array (
                'id' => 50,
                'code' => 'MY1UNIT6',
                'type' => 0,
                'size' => 1000.0,
                'floor_id' => 1,
                'number' => 6,
                'is_active' => 1,
                'picture' => 'b2b30297ff6fc2390e7b370dfd45a701.png',
            ),
            6 => 
            array (
                'id' => 51,
                'code' => 'MY1UNIT7',
                'type' => 0,
                'size' => 100.0,
                'floor_id' => 1,
                'number' => 7,
                'is_active' => 1,
                'picture' => '57632855471fb81178569cfc08e66b83.png',
            ),
            7 => 
            array (
                'id' => 52,
                'code' => 'MY1UNIT8',
                'type' => 0,
                'size' => 100.0,
                'floor_id' => 1,
                'number' => 8,
                'is_active' => 1,
                'picture' => '115c81b8d4ed2673574a147c5b627be6.png',
            ),
            8 => 
            array (
                'id' => 53,
                'code' => 'MY1UNIT9',
                'type' => 0,
                'size' => 101.0,
                'floor_id' => 1,
                'number' => 9,
                'is_active' => 1,
                'picture' => '9a14ded048d74b4472ff7697a017c252.png',
            ),
            9 => 
            array (
                'id' => 54,
                'code' => 'MY1UNIT10',
                'type' => 0,
                'size' => 100.0,
                'floor_id' => 1,
                'number' => 10,
                'is_active' => 1,
                'picture' => '2ac6f8d5421ce314c8797d953a3cf642.png',
            ),
            10 => 
            array (
                'id' => 55,
                'code' => 'CON1UNIT1',
                'type' => 0,
                'size' => 120.0,
                'floor_id' => 5,
                'number' => 1,
                'is_active' => 1,
                'picture' => 'f6259488c1262a81660f68f0d80b61fd.png',
            ),
            11 => 
            array (
                'id' => 56,
                'code' => 'CON1UNIT2',
                'type' => 1,
                'size' => 230.0,
                'floor_id' => 5,
                'number' => 2,
                'is_active' => 1,
                'picture' => 'ab0efa8f7e2caec81ec12f61218360ed.png',
            ),
            12 => 
            array (
                'id' => 57,
                'code' => 'CON1UNIT3',
                'type' => 0,
                'size' => 200.0,
                'floor_id' => 5,
                'number' => 3,
                'is_active' => 1,
                'picture' => '03c6c140ec14e41f8753ed61cb03e223.png',
            ),
            13 => 
            array (
                'id' => 58,
                'code' => 'CON1UNIT4',
                'type' => 0,
                'size' => 203.0,
                'floor_id' => 5,
                'number' => 4,
                'is_active' => 1,
                'picture' => '3b8a90d8168b0c85e2dc8da636e6d633.png',
            ),
            14 => 
            array (
                'id' => 59,
                'code' => 'CON2UNIT1',
                'type' => 1,
                'size' => 213.0,
                'floor_id' => 6,
                'number' => 1,
                'is_active' => 1,
                'picture' => 'a03e9a8a77766ecb80322569ae49be48.png',
            ),
            15 => 
            array (
                'id' => 60,
                'code' => 'CON2UNIT2',
                'type' => 1,
                'size' => 133.0,
                'floor_id' => 6,
                'number' => 2,
                'is_active' => 1,
                'picture' => '0b2e79dc2545e3b817213f03bd678dbe.png',
            ),
            16 => 
            array (
                'id' => 61,
                'code' => 'CON2UNIT3',
                'type' => 0,
                'size' => 131.0,
                'floor_id' => 6,
                'number' => 3,
                'is_active' => 1,
                'picture' => '59d3fd143eb27bd2dcfc5eb18cf8945c.png',
            ),
            17 => 
            array (
                'id' => 62,
                'code' => 'CON2UNIT4',
                'type' => 0,
                'size' => 131.0,
                'floor_id' => 6,
                'number' => 4,
                'is_active' => 1,
                'picture' => '00581fcae46aaa3a517affa11576d09e.png',
            ),
            18 => 
            array (
                'id' => 63,
                'code' => 'CON3UNIT1',
                'type' => 0,
                'size' => 131.0,
                'floor_id' => 7,
                'number' => 1,
                'is_active' => 1,
                'picture' => '318739a87a11ef34cdf41eb591d51e55.png',
            ),
            19 => 
            array (
                'id' => 64,
                'code' => 'CON3UNIT2',
                'type' => 1,
                'size' => 212.0,
                'floor_id' => 7,
                'number' => 2,
                'is_active' => 1,
                'picture' => 'b9f5883bf453fbe6226325b0b26231c7.png',
            ),
            20 => 
            array (
                'id' => 65,
                'code' => 'CON4UNIT1',
                'type' => 0,
                'size' => 133.0,
                'floor_id' => 8,
                'number' => 1,
                'is_active' => 1,
                'picture' => 'd1bc98d28acea17a6c4d64743bb14cd0.png',
            ),
            21 => 
            array (
                'id' => 66,
                'code' => 'CON4UNIT2',
                'type' => 0,
                'size' => 133.0,
                'floor_id' => 8,
                'number' => 2,
                'is_active' => 1,
                'picture' => '79a7017dc6a7da0c158b1f7b8baf159e.png',
            ),
            22 => 
            array (
                'id' => 67,
                'code' => 'MCD1UNIT1',
                'type' => 1,
                'size' => 203.0,
                'floor_id' => 2,
                'number' => 1,
                'is_active' => 1,
                'picture' => 'a67ec37975e40b41198ab4d30ea0610b.png',
            ),
            23 => 
            array (
                'id' => 68,
                'code' => 'PLA1UNIT1',
                'type' => 0,
                'size' => 123.0,
                'floor_id' => 9,
                'number' => 1,
                'is_active' => 1,
                'picture' => 'ffb412190765a918f6e1b74a09a9315f.png',
            ),
            24 => 
            array (
                'id' => 69,
                'code' => 'PLA1UNIT2',
                'type' => 1,
                'size' => 213.0,
                'floor_id' => 9,
                'number' => 2,
                'is_active' => 1,
                'picture' => 'fbeacc439d01569464ae618b86f9a12d.png',
            ),
            25 => 
            array (
                'id' => 70,
                'code' => 'PLA1UNIT3',
                'type' => 1,
                'size' => 314.0,
                'floor_id' => 9,
                'number' => 3,
                'is_active' => 1,
                'picture' => 'be871584e0084d9b02d2545e88f5846a.png',
            ),
            26 => 
            array (
                'id' => 71,
                'code' => 'PLA2UNIT1',
                'type' => 1,
                'size' => 350.0,
                'floor_id' => 10,
                'number' => 1,
                'is_active' => 1,
                'picture' => 'bd40c3e851e62067621deeea3147f940.png',
            ),
            27 => 
            array (
                'id' => 72,
                'code' => 'PLA2UNIT2',
                'type' => 1,
                'size' => 311.0,
                'floor_id' => 10,
                'number' => 2,
                'is_active' => 1,
                'picture' => '3dba7a1ec161ca65eb01ad76ca0a139b.png',
            ),
            28 => 
            array (
                'id' => 73,
                'code' => 'PLA2UNIT3',
                'type' => 1,
                'size' => 110.85,
                'floor_id' => 10,
                'number' => 3,
                'is_active' => 1,
                'picture' => 'b9e4ac11347dbc454b15fd1e884a635d.png',
            ),
        ));
        
        
    }
}