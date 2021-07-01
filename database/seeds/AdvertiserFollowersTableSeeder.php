<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdvertiserFollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('advertiser_followers')->insert([
            'advertiser_id' => 1,
            'follower_id' => 2,
        ]);

        DB::table('advertiser_followers')->insert([
            'advertiser_id' => 2,
            'follower_id' => 1,
        ]);
    }
}
