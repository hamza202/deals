<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('social')->insert([
            'name' => 'اليوتيوب',
            'link' => 'link',

        ]);

        DB::table('social')->insert([
            'name' => 'تويتر',
            'link' => 'link',

        ]); DB::table('social')->insert([
            'name' => 'انستجرام',
            'link' => 'link',

        ]); DB::table('social')->insert([
            'name' => 'سناب شات',
            'link' => 'link',

        ]); DB::table('social')->insert([
            'name' => 'ايميل',
            'link' => 'link',

        ]); DB::table('social')->insert([
            'name' => 'الهاتف',
            'link' => 'link',

        ]); DB::table('social')->insert([
            'name' => 'واتس اب',
            'link' => 'link',

        ]);
    }
}
