<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportAbuseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('report_abuse')->insert([
            'advertiser_id' => 2,
            'address' => 'اختبار',
            'abuse_type' => 'test',
            'comment' => 'التسجيل فى موقع ديل ',
        ]);

        DB::table('report_abuse')->insert([
            'advertiser_id' => 2,
            'address' => 'اختبار',
            'abuse_type' => 'test',
            'comment' => 'التسجيل فى موقع ديل ',
        ]);

        DB::table('report_abuse')->insert([
            'advertiser_id' => 2,
            'address' => 'اختبار',
            'abuse_type' => 'test',
            'comment' => 'التسجيل فى موقع ديل ',
        ]);
    }
}
