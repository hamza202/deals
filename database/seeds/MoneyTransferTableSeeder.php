<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MoneyTransferTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('money_transfer')->insert([
            'name' => 'اختبار 1',
            'bank_name' => 'advertiser',
            'files' => 'no_image.png',
            'email' => 'test@test.com',
            'phone' => '0597988529',
            'advertising_id' => 1,
            'money' => 10,
            'status' => 0,
        ]);

        DB::table('money_transfer')->insert([
            'name' => 'اختبار 1',
            'bank_name' => 'advertiser',
            'files' => 'no_image.png',
            'email' => 'test@test.com',
            'phone' => '0597988529',
            'advertising_id' => 2,
            'money' => 10,
            'status' => 0,
        ]);
    }
}
