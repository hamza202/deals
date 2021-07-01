<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdvertiserPointsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {
        DB::table('advertiser_points')->insert([
            'advertiser_id' => 1 ,
            'point_id' => 1,
            'num_points' => 100,
            'activity' => 'التسجيل فى ديل ',
        ]);

        DB::table('advertiser_points')->insert([
            'advertiser_id' => 2 ,
            'point_id' => 1,
            'num_points' => 100,
            'activity' => ' التسجيل فى ديل ',
        ]);
    }
}
