<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModeratoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('moderators')->insert([
            'name' => 'اختبار 1',
            'password' => bcrypt('123456'),
            'username' => 'اختبار 1',
            'email' => 'test@test.com',
            'phone' => '0597988529',
        ]);

        DB::table('moderators')->insert([
            'name' => 'اختبار 2',
            'password' => bcrypt('123456'),
            'username' => 'اختبار 2',
            'email' => 'test2@test.com',
            'phone' => '0597988528',
        ]);
    }
}
