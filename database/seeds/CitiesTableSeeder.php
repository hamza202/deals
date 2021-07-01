<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            'name' => 'الرياض',
            'country_id' => 1,
        ]);

        DB::table('cities')->insert([
            'name' => 'جدة',
            'country_id' => 1,
        ]);

        DB::table('cities')->insert([
            'name' => 'الدمام',
            'country_id' => 1,
        ]);

        DB::table('cities')->insert([
            'name' => 'المدينة المنورة',
            'country_id' => 1,
        ]);
    }
}
