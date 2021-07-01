<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KnowUsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('know_us')->insert([
            'name' => 'انستجرام',
        ]);
        DB::table('know_us')->insert([
            'name' => 'سناب شات',
        ]);
        DB::table('know_us')->insert([
            'name' => 'تويتر',
        ]);
        DB::table('know_us')->insert([
            'name' => 'صديق',
        ]);
        DB::table('know_us')->insert([
            'name' => 'جوجل',
        ]);
        DB::table('know_us')->insert([
            'name' => 'يوتيوب',
        ]);
        DB::table('know_us')->insert([
            'name' => 'فيسبوك',
        ]);
        DB::table('know_us')->insert([
            'name' => 'أخرى',
        ]);
    }
}
