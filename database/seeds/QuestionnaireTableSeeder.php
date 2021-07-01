<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionnaireTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questionnaire')->insert([
            'url' => 'https://docs.google.com/forms/d/e/1FAIpQLSeexYRvpOGzFZLqbG1OfigN9S24L2zFPFOuZeLI-acxknUHiA/viewform',
        ]);
    }
}
