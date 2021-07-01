<?php

use Illuminate\Database\Seeder;

class ISeedAdvertisersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('advertisers')->delete();
        
        \DB::table('advertisers')->insert(array (
            0 => 
            array (
                'id' => 8,
                'name' => 'Mai',
                'photo' => NULL,
                'username' => 'mai',
                'email' => 'mai@gmail.com',
                'password' => '123123',
                'city_id' => 1,
                'is_active' => 1,
                'membership_id' => 1,
                'address' => NULL,
                'know_us' => NULL,
                'phone' => '0597880275',
                'remember_token' => NULL,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}