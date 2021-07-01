<?php

use Illuminate\Database\Seeder;

class ISeedAdvertisingTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('advertising')->delete();
        
        \DB::table('advertising')->insert(array (
            0 => 
            array (
                'id' => 19,
                'advertiser_id' => 1,
                'category_id' => 1,
                'sub_category_id' => 1,
                'city_id' => 1,
                'package_id' => 1,
                'title' => 'dsfsd',
                'photos' => NULL,
                'price' => '333',
                'insurance_price' => '33',
                'phone' => '324234234',
                'address' => 'sdfsdf',
                'description' => 'sdfsdfsdf',
                'comments' => 0,
                'special_conditions' => NULL,
                'is_specialconditions' => 0,
                'is_phone' => 0,
                'vedio_url' => '0',
                'status' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}