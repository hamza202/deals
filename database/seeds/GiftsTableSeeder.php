<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GiftsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {
        DB::table('gifts')->insert([
            'name' => ' ساعة يد',
            'photo' => 'images/gifts/1598027590.jpg',
            'points' => 100,
            'membership_id' => 1,
            'available' => 1,
        ]);
        DB::table('gifts')->insert([
            'name' => ' ساعة يد',
            'photo' => 'images/gifts/1598027590.jpg',
            'points' => 100,
            'membership_id' => 1,
            'available' => 1,
        ]);
        DB::table('gifts')->insert([
            'name' => ' ساعة يد',
            'photo' => 'images/gifts/1598027590.jpg',
            'points' => 100,
            'membership_id' => 1,
            'available' => 1,
        ]);
        DB::table('gifts')->insert([
            'name' => ' ساعة يد',
            'photo' => 'images/gifts/1598027590.jpg',
            'points' => 100,
            'membership_id' => 1,
            'available' => 1,
        ]);
        DB::table('gifts')->insert([
            'name' => ' ساعة يد',
            'photo' => 'images/gifts/1598027590.jpg',
            'points' => 100,
            'membership_id' => 1,
            'available' => 0,
        ]);
        DB::table('gifts')->insert([
            'name' => ' ساعة يد',
            'photo' => 'images/gifts/1598027590.jpg',
            'points' => 100,
            'membership_id' => 1,
            'available' => 0,
        ]);
    }
}
