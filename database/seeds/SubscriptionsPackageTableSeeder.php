<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriptionsPackageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {


        DB::table('subscriptions_package')->insert([
            'name' => 'باقة 1',
            'price' => 50,
            'time_line' => 20,
            'discount' => 0
        ]);


        DB::table('subscriptions_package')->insert([
            'name' => 'باقة 2',
            'price' => 50,
            'time_line' => 20,
            'discount' => 0
        ]);

        DB::table('subscriptions_package')->insert([
            'name' => 'باقة 3',
            'price' => 50,
            'time_line' => 20,
            'discount' => 10
        ]);

        DB::table('subscriptions_package')->insert([
            'name' => 'باقة 4',
            'price' => 50,
            'time_line' => 20,
            'discount' => 50
        ]);
    }
}
