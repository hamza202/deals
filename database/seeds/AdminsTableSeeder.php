<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('admins')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'phone' => '0597988529',
            'photo' => null,
            'password' => bcrypt('123456'),
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
