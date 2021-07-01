<?php

use Illuminate\Database\Seeder;

class ISeedAdvertisingCommentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('advertising_comments')->delete();
        
        \DB::table('advertising_comments')->insert(array (
            0 => 
            array (
                'id' => 4,
                'advertising_id' => 1,
                'writer_id' => 1,
                'comment' => 'test ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}