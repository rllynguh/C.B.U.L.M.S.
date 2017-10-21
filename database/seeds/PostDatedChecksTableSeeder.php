<?php

use Illuminate\Database\Seeder;

class PostDatedChecksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('post_dated_checks')->delete();
        
        
        
    }
}