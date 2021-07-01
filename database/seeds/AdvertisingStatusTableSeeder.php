<?php

use Illuminate\Database\Seeder;

class AdvertisingStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $names = [
            'مقبول',
            'مثبت',
            'منتهي',
        ];

        foreach ($names as $name) {
            \App\Models\AdvertisingStatus::create(['name' => $name]);
        }
    }
}
