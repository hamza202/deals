<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plan')->insert([
            'advertising' => 2,
            'membership' => 1,
            'subscriptions_id' => 1,
        ]);

        DB::table('plan')->insert([
            'advertising' => 2,
            'membership' => 1,
            'subscriptions_id' => 2,
        ]);

        DB::table('plan')->insert([
            'advertising' => 2,
            'membership' => 1,
            'subscriptions_id' =>3,
        ]);

        DB::table('plan')->insert([
            'advertising' => 2,
            'membership' => 1,
            'subscriptions_id' => 4,
        ]);
    }
}
