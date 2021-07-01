<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\City;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(City::class, function (Faker $faker) {
    return [
        'id' => $faker->id,
        'name' => $faker->name,
        'country_id' => 1,
        'created_at'=>null,
        'updated_at' => null
    ];
});
