<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GiftReplaceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {
        DB::table('gift_replace')->insert([
            'gift_id' => 1,
            'address' => 'الرياض',
            'advertiser_id' => 1,
            'accept' => 0,
        ]);

        DB::table('gift_replace')->insert([
            'gift_id' => 2,
            'address' => 'الرياض',
            'advertiser_id' => 1,
            'accept' => 0,
        ]);
    }
}
