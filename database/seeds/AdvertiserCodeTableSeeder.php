<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdvertiserCodeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sms_advertiser_code')->insert([
            'advertiser_id' => 1,
            'advertiser_number' => '0597988529',
            'code' => '12345',
            'status' => 0,
        ]);

        DB::table('sms_advertiser_code')->insert([
            'advertiser_id' => 2,
            'advertiser_number' => '0597988529',
            'code' => '12345',
            'status' => 0,
        ]);

        DB::table('sms_advertiser_code')->insert([
            'advertiser_id' => 3,
            'advertiser_number' => '0597988529',
            'code' => '12345',
            'status' => 0,
        ]);


    }
}
