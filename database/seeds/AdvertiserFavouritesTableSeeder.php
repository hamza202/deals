<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdvertiserFavouritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('advertiser_favourites')->insert([
            'advertiser_id' => 1,
            'advertising_id' => 2,
        ]);

        DB::table('advertiser_favourites')->insert([
            'advertiser_id' => 2,
            'advertising_id' => 1,
        ]);
    }
}
