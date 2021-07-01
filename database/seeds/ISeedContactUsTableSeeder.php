<?php

use Illuminate\Database\Seeder;

class ISeedContactUsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('contact_us')->delete();
        
        \DB::table('contact_us')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'مي',
                'email' => 'mai@gmail.com',
                'phone' => '0597988529',
                'title' => 'test',
                'message' => 'test test test test  test',
                'address' => 'حي التفاح',
                'whatsapp' => '0597988529',
                'created_at' => '2020-08-10 08:34:05',
                'updated_at' => '2020-08-10 08:34:05',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'مي',
                'email' => 'mai@gmail.com',
                'phone' => '0597988529',
                'title' => 'test',
                'message' => 'ddddddddddddddddd',
                'address' => 'حي التفاح',
                'whatsapp' => '0597988529',
                'created_at' => '2020-08-10 08:35:37',
                'updated_at' => '2020-08-10 08:35:37',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'new',
                'email' => 'mai@gmail.com',
                'phone' => '0597988529',
                'title' => 'test',
                'message' => 'test',
                'address' => 'test',
                'whatsapp' => '0597988529',
                'created_at' => '2020-08-11 19:08:27',
                'updated_at' => '2020-08-11 19:08:27',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'مي',
                'email' => 'new11@gmail.com',
                'phone' => '0597988529',
                'title' => 'مي',
                'message' => 'ؤؤؤؤؤؤؤؤؤؤؤؤؤؤؤؤؤؤؤؤؤؤ',
                'address' => 'مي',
                'whatsapp' => '0597988529',
                'created_at' => '2020-08-11 23:37:40',
                'updated_at' => '2020-08-11 23:37:40',
            ),
        ));
        
        
    }
}