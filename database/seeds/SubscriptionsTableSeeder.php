<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('subscriptions')->insert([
            'advertiser_id' => 1,
            'package_id' => 1,
            'status' => 0,
            'start_date' => null,
            'end_date' => null,

        ]);

        DB::table('subscriptions')->insert([
            'advertiser_id' => 2,
            'package_id' => 1,
            'status' => 0,
            'start_date' => null,
            'end_date' => null,
        ]);


        DB::table('subscriptions')->insert([
            'advertiser_id' => 3,
            'package_id' => 1,
            'status' => 1,
            'start_date' => '2020-08-21',
            'end_date' => '2020-08-29',
        ]);
    }
}
