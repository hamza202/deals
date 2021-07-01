<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlackListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('black_list')->insert([
            'advertiser_id' => '3',
            'reason' => 'السبب السبب ',
        ]);
    }
}
