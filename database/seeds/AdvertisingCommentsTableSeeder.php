<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdvertisingCommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {
         DB::table('advertising_comments')->insert([
            'advertising_id' => 1,
            'writer_id' => 2,
            'parent_id' => 0,
            'comment' => ' اختبار اختبار',
        ]);

         DB::table('advertising_comments')->insert([
            'advertising_id' => 2,
            'writer_id' => 2,
             'parent_id' => 1,
            'comment' => ' اختبار اختبار',
        ]);
    }
}
