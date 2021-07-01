<?php

use Illuminate\Database\Seeder;

class ISeedReportAbuseTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('report_abuse')->delete();
        
        \DB::table('report_abuse')->insert(array (
            0 => 
            array (
                'id' => 1,
                'advertiser_id' => 2,
                'address' => 'غزة',
                'abuse_type' => 'اساءة تعامل',
                'comment' => 'اساءة تعامل',
                'created_at' => '2020-08-12 11:15:29',
                'updated_at' => '2020-08-12 11:15:29',
            ),
            1 => 
            array (
                'id' => 2,
                'advertiser_id' => 2,
                'address' => 'test',
                'abuse_type' => 'اساءة تعامل',
                'comment' => 'test',
                'created_at' => '2020-08-12 11:17:03',
                'updated_at' => '2020-08-12 11:17:03',
            ),
            2 => 
            array (
                'id' => 3,
                'advertiser_id' => 2,
                'address' => 'test',
                'abuse_type' => 'test',
                'comment' => 'test test',
                'created_at' => '2020-08-12 11:17:42',
                'updated_at' => '2020-08-12 11:17:42',
            ),
            3 => 
            array (
                'id' => 4,
                'advertiser_id' => 2,
                'address' => 'حي التفاح',
                'abuse_type' => 'اساءة تعامل',
                'comment' => 'ggggggggggggggggggggg',
                'created_at' => '2020-08-15 07:51:12',
                'updated_at' => '2020-08-15 07:51:12',
            ),
            4 => 
            array (
                'id' => 5,
                'advertiser_id' => 2,
                'address' => 'حي التفاح',
                'abuse_type' => 'اساءة تعامل',
                'comment' => 'hhhhhhhhhhhhhhhhhh',
                'created_at' => '2020-08-15 07:56:23',
                'updated_at' => '2020-08-15 07:56:23',
            ),
            5 => 
            array (
                'id' => 6,
                'advertiser_id' => 2,
                'address' => 'حي التفاح',
                'abuse_type' => 'اساءة تعامل',
                'comment' => 'hhhhhhhhhhhhhhhhhhhhh',
                'created_at' => '2020-08-15 07:56:38',
                'updated_at' => '2020-08-15 07:56:38',
            ),
            6 => 
            array (
                'id' => 7,
                'advertiser_id' => 2,
                'address' => 'test',
                'abuse_type' => 'test',
                'comment' => 'ddddddddddddddddddddddddddddd',
                'created_at' => '2020-08-15 07:57:31',
                'updated_at' => '2020-08-15 07:57:31',
            ),
            7 => 
            array (
                'id' => 8,
                'advertiser_id' => 2,
                'address' => 'حي التفاح',
                'abuse_type' => 'test',
                'comment' => 'ccccccccccccccccccccc',
                'created_at' => '2020-08-15 07:57:53',
                'updated_at' => '2020-08-15 07:57:53',
            ),
        ));
        
        
    }
}