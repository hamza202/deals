<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MembershipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('membership')->insert([
            'title' => 'كلاسيكية',
            'photo' => 'images/membership/1598462358.svg',
            'qualifications' => 'االمؤهلات المؤهلات المؤهلات المؤهلات',
            'features' => 'المميزات المميزات المميزات المميزات المميزات',
        ]);

        DB::table('membership')->insert([
            'title' => 'فضية',
            'photo' => 'images/membership/1598462378.svg',
            'qualifications' => 'االمؤهلات المؤهلات المؤهلات المؤهلات',
            'features' => 'المميزات المميزات المميزات المميزات المميزات',
        ]);


        DB::table('membership')->insert([
            'title' => 'ذهبية',
            'photo' => 'images/membership/1598462343.svg',
            'qualifications' => 'االمؤهلات المؤهلات المؤهلات المؤهلات',
            'features' => 'المميزات المميزات المميزات المميزات المميزات',
        ]);

        DB::table('membership')->insert([
            'title' => 'سجنيتشر',
            'photo' => 'images/membership/1598462320.svg',
            'qualifications' => 'االمؤهلات المؤهلات المؤهلات المؤهلات',
            'features' => 'المميزات المميزات المميزات المميزات المميزات',
        ]);
    }
}
