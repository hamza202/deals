<?php

use Illuminate\Database\Seeder;

class ISeedCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'سيارات',
                'parent_id' => '0',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'ملابس',
                'parent_id' => '0',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => '2020-08-17 18:42:08',
            ),
            2 => 
            array (
                'id' => 4,
                'name' => 'طائرات',
                'parent_id' => '0',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => '2020-08-17 18:41:35',
            ),
            3 => 
            array (
                'id' => 5,
                'name' => 'مرسيدس',
                'parent_id' => '1',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 6,
                'name' => 'جولف',
                'parent_id' => '1',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 9,
                'name' => 'أجهزة كهربائية',
                'parent_id' => '0',
                'deleted_at' => NULL,
                'created_at' => '2020-08-17 18:52:43',
                'updated_at' => '2020-08-17 18:52:43',
            ),
            6 => 
            array (
                'id' => 10,
                'name' => 'new',
                'parent_id' => '1',
                'deleted_at' => NULL,
                'created_at' => '2020-08-18 04:45:56',
                'updated_at' => '2020-08-18 04:45:56',
            ),
            7 => 
            array (
                'id' => 11,
                'name' => 'أطفال',
                'parent_id' => '2',
                'deleted_at' => NULL,
                'created_at' => '2020-08-18 04:46:56',
                'updated_at' => '2020-08-18 04:46:56',
            ),
            8 => 
            array (
                'id' => 12,
                'name' => 'رجال',
                'parent_id' => '2',
                'deleted_at' => NULL,
                'created_at' => '2020-08-18 04:47:43',
                'updated_at' => '2020-08-18 06:02:58',
            ),
            9 => 
            array (
                'id' => 13,
                'name' => 'نساء',
                'parent_id' => '2',
                'deleted_at' => NULL,
                'created_at' => '2020-08-18 05:55:18',
                'updated_at' => '2020-08-18 05:55:18',
            ),
            10 => 
            array (
                'id' => 14,
                'name' => 'new',
                'parent_id' => '1',
                'deleted_at' => NULL,
                'created_at' => '2020-08-18 06:17:52',
                'updated_at' => '2020-08-18 06:17:52',
            ),
            11 => 
            array (
                'id' => 15,
                'name' => 'new',
                'parent_id' => '1',
                'deleted_at' => NULL,
                'created_at' => '2020-08-18 06:18:29',
                'updated_at' => '2020-08-18 06:18:29',
            ),
            12 => 
            array (
                'id' => 16,
                'name' => 'new',
                'parent_id' => '1',
                'deleted_at' => NULL,
                'created_at' => '2020-08-18 06:20:05',
                'updated_at' => '2020-08-18 06:20:05',
            ),
            13 => 
            array (
                'id' => 17,
                'name' => 'غسالات',
                'parent_id' => '9',
                'deleted_at' => NULL,
                'created_at' => '2020-08-18 06:20:27',
                'updated_at' => '2020-08-18 06:20:27',
            ),
            14 => 
            array (
                'id' => 18,
                'name' => 'tv',
                'parent_id' => '9',
                'deleted_at' => NULL,
                'created_at' => '2020-08-18 06:21:57',
                'updated_at' => '2020-08-18 06:21:57',
            ),
            15 => 
            array (
                'id' => 19,
                'name' => 'new',
                'parent_id' => '9',
                'deleted_at' => NULL,
                'created_at' => '2020-08-18 06:24:39',
                'updated_at' => '2020-08-18 06:24:39',
            ),
            16 => 
            array (
                'id' => 20,
                'name' => 'new 2',
                'parent_id' => '9',
                'deleted_at' => NULL,
                'created_at' => '2020-08-18 06:25:24',
                'updated_at' => '2020-08-18 06:29:15',
            ),
            17 => 
            array (
                'id' => 21,
                'name' => 'new test',
                'parent_id' => '9',
                'deleted_at' => NULL,
                'created_at' => '2020-08-18 06:28:59',
                'updated_at' => '2020-08-18 06:29:25',
            ),
            18 => 
            array (
                'id' => 22,
                'name' => 'test',
                'parent_id' => '9',
                'deleted_at' => NULL,
                'created_at' => '2020-08-18 06:29:37',
                'updated_at' => '2020-08-18 06:29:37',
            ),
            19 => 
            array (
                'id' => 23,
                'name' => 'test',
                'parent_id' => '4',
                'deleted_at' => NULL,
                'created_at' => '2020-08-18 06:29:55',
                'updated_at' => '2020-08-18 06:29:55',
            ),
            20 => 
            array (
                'id' => 24,
                'name' => 'test',
                'parent_id' => '4',
                'deleted_at' => NULL,
                'created_at' => '2020-08-18 06:30:41',
                'updated_at' => '2020-08-18 06:30:41',
            ),
            21 => 
            array (
                'id' => 25,
                'name' => 'new',
                'parent_id' => '4',
                'deleted_at' => NULL,
                'created_at' => '2020-08-18 06:30:50',
                'updated_at' => '2020-08-18 06:30:50',
            ),
        ));
        
        
    }
}