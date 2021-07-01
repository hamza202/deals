<?php

use Illuminate\Database\Seeder;

class ISeedCitiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cities')->delete();
        
        \DB::table('cities')->insert(array (
            0 => 
            array (
                'id' => 3,
                'name' => 'مكة المكرمة',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 12,
                'name' => 'الرياض',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 13,
                'name' => 'جدة',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 14,
                'name' => 'مكة المكرمة',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 15,
                'name' => 'حائل',
                'country_id' => 1,
                'created_at' => '2020-08-09 13:19:36',
                'updated_at' => '2020-08-09 13:19:36',
            ),
            5 => 
            array (
                'id' => 16,
                'name' => 'الرياض',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 17,
                'name' => 'جدة',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 18,
                'name' => 'مكة المكرمة',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 19,
                'name' => 'حائل',
                'country_id' => 1,
                'created_at' => '2020-08-09 13:19:36',
                'updated_at' => '2020-08-09 13:19:36',
            ),
            9 => 
            array (
                'id' => 20,
                'name' => 'الرياض',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 21,
                'name' => 'جدة',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 22,
                'name' => 'مكة المكرمة',
                'country_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 23,
                'name' => 'حائل',
                'country_id' => 1,
                'created_at' => '2020-08-09 13:19:36',
                'updated_at' => '2020-08-09 13:19:36',
            ),
            13 => 
            array (
                'id' => 24,
                'name' => 'الدمام',
                'country_id' => 1,
                'created_at' => '2020-08-17 09:19:46',
                'updated_at' => '2020-08-18 06:48:40',
            ),
            14 => 
            array (
                'id' => 25,
                'name' => 'test',
                'country_id' => 1,
                'created_at' => '2020-08-18 06:41:23',
                'updated_at' => '2020-08-18 06:48:19',
            ),
        ));
        
        
    }
}