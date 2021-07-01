<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PointsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('points')->insert([
            'activity' => 'التسجيل فى ديل ',
            'num_points' => 100,
            'total_subscriptions' => 0,
            'code' => 1
        ]);


        DB::table('points')->insert([
            'activity' => 'الإعلان الاول فى الموقع',
            'num_points' => 100,
            'total_subscriptions' => 0,
            'code' => 2
        ]);

        DB::table('points')->insert([
            'activity' => 'الإعلان  فى الموقع',
            'num_points' => 100,
            'total_subscriptions' => 0,
            'code' => 3
        ]);

        DB::table('points')->insert([
            'activity' => 'حصول المعلن على متابعه كحد اقصى',
            'num_points' => 100,
            'total_subscriptions' => 0,
            'code' => 4
        ]);


        DB::table('points')->insert([
            'activity' => 'حصول المعلن على تقييم كحد اقصى',
            'num_points' => 100,
            'total_subscriptions' => 0,
            'code' => 5
        ]);

        DB::table('points')->insert([
            'activity' => 'حصول الإعلان على مشاهدة بحد اقصى ',
            'num_points' => 100,
            'total_subscriptions' => 0,
            'code' => 6
        ]);

        DB::table('points')->insert([
            'activity' => 'حصول الإعلان على اعجاب بحد اقصى ',
            'num_points' => 100,
            'total_subscriptions' => 0,
            'code' => 7
        ]);

        DB::table('points')->insert([
            'activity' => 'دفع العضو للعموله',
            'num_points' => 100,
            'total_subscriptions' => 0,
            'code' => 8
        ]);


        DB::table('points')->insert([
            'activity' => 'توثيق الحساب',
            'num_points' => 100,
            'total_subscriptions' => 0,
            'code' => 9
        ]);


        DB::table('points')->insert([
            'activity' => 'الابلاغ عن عضو مخالف',
            'num_points' => 100,
            'total_subscriptions' => 0,
            'code' => 10
        ]);


        DB::table('points')->insert([
            'activity' => 'تفعيل الحساب عن طريق الواتساب',
            'num_points' => 100,
            'total_subscriptions' => 0,
            'code' => 11
        ]);
    }
}
