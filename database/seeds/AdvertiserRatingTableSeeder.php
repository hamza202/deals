<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdvertiserRatingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('advertiser_rating')->insert([
            'advertiser_id' =>1,
            'voter_id' => 2,
            'advertising_id' =>1,
            'rating' => 5,
        ]);
    }
}
