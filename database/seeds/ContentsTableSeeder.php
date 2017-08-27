<?php

use Illuminate\Database\Seeder;

class ContentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('contents')->delete();
        
        \DB::table('contents')->insert(array (
            0 => 
            array (
                'id' => 1,
                'description' => 'Tenants should',
                'is_active' => '1',
            ),
            1 => 
            array (
                'id' => 2,
                'description' => 'Tenants shouldn\'t',
                'is_active' => '1',
            ),
        ));
        
        
    }
}