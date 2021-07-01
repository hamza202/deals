<?php

use Illuminate\Database\Seeder;

class ISeedConsultationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('consultations')->delete();
        
        \DB::table('consultations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'advertiser_id' => 2,
                'name' => 'مي',
                'email' => 'mai@gmail.com',
                'phone' => '0597988529',
                'consultations' => 'بيانات مقدم الطلب',
                'created_at' => '2020-08-12 11:35:45',
                'updated_at' => '2020-08-12 11:35:45',
            ),
        ));
        
        
    }
}