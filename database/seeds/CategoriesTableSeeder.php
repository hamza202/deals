<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('categories')->insert([

            'name' => 'سيارات',
            'parent_id' => 0,
        ]);


        DB::table('categories')->insert([

            'name' => 'عقارات',
            'parent_id' => 0,
        ]);

        DB::table('categories')->insert([

            'name' => 'الكترونيات',
            'parent_id' => 0,
        ]);

        DB::table('categories')->insert([
            'name' => 'سيارات 1',
            'parent_id' => 1,
        ]);


        DB::table('categories')->insert([
            'name' => 'سيارات 2',
            'parent_id' => 1,
        ]);

        DB::table('categories')->insert([
            'name' => 'عقارات 1',
            'parent_id' => 2,
        ]);

        DB::table('categories')->insert([
            'name' => 'عقارات 2 ',
            'parent_id' => 2,
        ]);


        DB::table('categories')->insert([
            'name' => 'الكترونيات 1',
            'parent_id' => 3,
        ]);


      DB::table('categories')->insert([
            'name' => 'الكترونيات 2',
            'parent_id' => 3,
        ]);

    }
}
