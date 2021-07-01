<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KnowRightsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        DB::table('know_rights')->insert([
            'title' => ' خدمة اعرف حقك من ديل',
            'photo' => 'images/pages/search.svg',
            'content' => '   من باب الوضوح والشفافية يقدم ديل برنامج توعوي يتضمن رسائل',
        ]);

        DB::table('know_rights')->insert([
            'title' => ' خدمة اعرف حقك من ديل',
            'photo' => 'images/pages/for_how_service.svg',
            'content' => '   من باب الوضوح والشفافية يقدم ديل برنامج توعوي يتضمن رسائل',
        ]);

        DB::table('know_rights')->insert([
            'title' => ' خدمة اعرف حقك من ديل',
            'photo' => 'images/pages/objective-know-rights.svg',
            'content' => '   من باب الوضوح والشفافية يقدم ديل برنامج توعوي يتضمن رسائل',
        ]);

        DB::table('know_rights')->insert([
            'title' => ' خدمة اعرف حقك من ديل',
            'photo' => 'images/pages/what_is service.svg',
            'content' => '   من باب الوضوح والشفافية يقدم ديل برنامج توعوي يتضمن رسائل',
        ]);


        DB::table('know_rights')->insert([
            'title' => ' خدمة اعرف حقك من ديل',
            'photo' => 'images/pages/service_contactor.svg',
            'content' => '   من باب الوضوح والشفافية يقدم ديل برنامج توعوي يتضمن رسائل',
        ]);

        DB::table('know_rights')->insert([
            'title' => ' خدمة اعرف حقك من ديل',
            'photo' => 'images/pages/call-us-for-rights.svg',
            'content' => '   من باب الوضوح والشفافية يقدم ديل برنامج توعوي يتضمن رسائل',
        ]);


        DB::table('know_rights')->insert([
            'title' => ' خدمة اعرف حقك من ديل',
            'photo' => 'images/pages/time_to_answer.svg',
            'content' => '   من باب الوضوح والشفافية يقدم ديل برنامج توعوي يتضمن رسائل',
        ]);

        DB::table('know_rights')->insert([
            'title' => ' خدمة اعرف حقك من ديل',
            'photo' => 'images/pages/is_free_or_not.svg',
            'content' => '   من باب الوضوح والشفافية يقدم ديل برنامج توعوي يتضمن رسائل',
        ]);

        DB::table('know_rights')->insert([
            'title' => ' خدمة اعرف حقك من ديل',
            'photo' => 'images/pages/resposapility.svg',
            'content' => '   من باب الوضوح والشفافية يقدم ديل برنامج توعوي يتضمن رسائل',
        ]);
    }
}
