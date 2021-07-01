<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactUsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contact_us')->insert([
            'name' => 'اختبار 3',
            'email' => 'test3@test.com',
            'address' => 0,
            'phone' => '0597988529',
            'title' => 'اختبار',
            'whatsapp' => '0597988529',
            'message' => 'موقع ديل ',
        ]);

        DB::table('contact_us')->insert([
            'name' => 'اختبار 3',
            'email' => 'test3@test.com',
            'address' => 0,
            'phone' => '0597988529',
            'title' => 'اختبار',
            'whatsapp' => '0597988529',
            'message' => 'موقع ديل ',
        ]);

        DB::table('contact_us')->insert([
            'name' => 'اختبار 3',
            'email' => 'test3@test.com',
            'address' => 0,
            'phone' => '0597988529',
            'title' => 'اختبار',
            'whatsapp' => '0597988529',
            'message' => 'موقع ديل ',
        ]);

        DB::table('contact_us')->insert([
            'name' => 'اختبار 3',
            'email' => 'test3@test.com',
            'address' => 0,
            'phone' => '0597988529',
            'title' => 'اختبار',
            'whatsapp' => '0597988529',
            'message' => 'موقع ديل ',
        ]);
    }
}
