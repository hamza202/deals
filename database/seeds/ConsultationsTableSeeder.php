<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConsultationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {
        DB::table('consultations')->insert([
            'advertiser_id' => 1,
            'name' => 'اختبار',
            'email' => 'test@test.com',
            'phone' => '0597988529',
            'consultations' => 'التسجيل فى موقع ديل ',
        ]);

        DB::table('consultations')->insert([
            'advertiser_id' => 2,
            'name' => 'اختبار',
            'email' => 'test@test.com',
            'phone' => '0597988529',
            'consultations' => 'التسجيل فى موقع ديل ',
        ]);
    }
}
