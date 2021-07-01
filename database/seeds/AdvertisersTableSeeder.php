<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdvertisersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('advertisers')->insert([
            'name' => 'اختبار 1',
            'photo' => 'images/advertiser-images/1597810389.jpg',
            'password' => bcrypt('123456'),
            'username' => 'اختبار 1',
            'email' => 'test@test.com',
            'city_id' => 1,
            'is_active' => 1,
            'know_us' => 1,
            'membership_id' => 1,
            'address' => 'الرياض',
            'phone' => '0597988529',
            'active_account' => 1
        ]);



        DB::table('advertisers')->insert([
            'name' => 'اختبار 2',
            'photo' => 'images/advertiser-images/1597810389.jpg',
            'password' => bcrypt('123456'),
            'username' => 'اختبار 2',
            'email' => 'test2@test.com',
            'city_id' => 1,
            'is_active' => 1,
            'know_us' => 1,
            'membership_id' => 1,
            'address' => 'الرياض',
            'phone' => '05979000529',
            'active_account' => 1
        ]);


        DB::table('advertisers')->insert([
            'name' => 'اختبار 3',
            'photo' => 'images/advertiser-images/1597810389.jpg',
            'password' => bcrypt('123456'),
            'username' => 'اختبار 3',
            'email' => 'test3@test.com',
            'city_id' => 1,
            'is_active' => 0,
            'know_us' => 2,
            'membership_id' => 1,
            'address' => 'الرياض',
            'phone' => '05979555529',
            'active_account' => 1
        ]);



    }
}
