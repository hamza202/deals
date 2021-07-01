<?php

use Illuminate\Database\Seeder;

class ISeedMembershipTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('membership')->delete();
        
        \DB::table('membership')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'كلاسيكية',
                'photo' => 'images/membership/classic.svg',
                'qualifications' => '["\\u0645\\u0624\\u0647\\u0644\\u0627\\u062a \\u0627\\u0644\\u0639\\u0636\\u0648\\u064a\\u0629 1","\\u0645\\u0624\\u0647\\u0644\\u0627\\u062a \\u0627\\u0644\\u0639\\u0636\\u0648\\u064a\\u0629 2"]',
                'features' => '["\\u0645\\u0645\\u064a\\u0632\\u0627\\u062a \\u0627\\u0644\\u0639\\u0636\\u0648\\u064a\\u0629 1","\\u0645\\u0645\\u064a\\u0632\\u0627\\u062a \\u0627\\u0644\\u0639\\u0636\\u0648\\u064a\\u0629 2"]',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'فضية',
                'photo' => 'images/membership/silver-member.svg',
                'qualifications' => '["\\u0645\\u0624\\u0647\\u0644\\u0627\\u062a \\u0627\\u0644\\u0639\\u0636\\u0648\\u064a\\u0629 1","\\u0645\\u0624\\u0647\\u0644\\u0627\\u062a \\u0627\\u0644\\u0639\\u0636\\u0648\\u064a\\u0629 2"]',
                'features' => '["\\u0645\\u0645\\u064a\\u0632\\u0627\\u062a \\u0627\\u0644\\u0639\\u0636\\u0648\\u064a\\u0629 1","\\u0645\\u0645\\u064a\\u0632\\u0627\\u062a \\u0627\\u0644\\u0639\\u0636\\u0648\\u064a\\u0629 2"]',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'ذهبية',
                'photo' => 'images/membership/gold-member.svg',
                'qualifications' => '["\\u0645\\u0624\\u0647\\u0644\\u0627\\u062a \\u0627\\u0644\\u0639\\u0636\\u0648\\u064a\\u0629 1","\\u0645\\u0624\\u0647\\u0644\\u0627\\u062a \\u0627\\u0644\\u0639\\u0636\\u0648\\u064a\\u0629 2"]',
                'features' => '["\\u0645\\u0645\\u064a\\u0632\\u0627\\u062a \\u0627\\u0644\\u0639\\u0636\\u0648\\u064a\\u0629 1","\\u0645\\u0645\\u064a\\u0632\\u0627\\u062a \\u0627\\u0644\\u0639\\u0636\\u0648\\u064a\\u0629 2"]',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'title' => 'سجنيتشر',
                'photo' => 'images/membership/seginture-member.svg',
                'qualifications' => '["\\u0645\\u0624\\u0647\\u0644\\u0627\\u062a \\u0627\\u0644\\u0639\\u0636\\u0648\\u064a\\u0629 1","\\u0645\\u0624\\u0647\\u0644\\u0627\\u062a \\u0627\\u0644\\u0639\\u0636\\u0648\\u064a\\u0629 2"]',
                'features' => '["\\u0645\\u0645\\u064a\\u0632\\u0627\\u062a \\u0627\\u0644\\u0639\\u0636\\u0648\\u064a\\u0629 1","\\u0645\\u0645\\u064a\\u0632\\u0627\\u062a \\u0627\\u0644\\u0639\\u0636\\u0648\\u064a\\u0629 2"]',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 6,
                'title' => 'test 1',
                'photo' => 'images/membership/1597741993.jpg',
                'qualifications' => '["\\u0645\\u0624\\u0647\\u0644\\u0627\\u062a \\u0627\\u0644\\u0639\\u0636\\u0648\\u064a\\u0629 1","\\u0645\\u0624\\u0647\\u0644\\u0627\\u062a \\u0627\\u0644\\u0639\\u0636\\u0648\\u064a\\u0629 2"]',
                'features' => '["\\u0645\\u0645\\u064a\\u0632\\u0627\\u062a \\u0627\\u0644\\u0639\\u0636\\u0648\\u064a\\u0629 1","\\u0645\\u0645\\u064a\\u0632\\u0627\\u062a \\u0627\\u0644\\u0639\\u0636\\u0648\\u064a\\u0629 2"]',
                'created_at' => '2020-08-18 09:13:13',
                'updated_at' => '2020-08-18 09:13:13',
            ),
        ));
        
        
    }
}