<?php

use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

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


$factory->define(User::class, function (Faker $faker) {
    return [
         'username' => $faker->username,
         'email' => $faker->unique()->safeEmail,
         'password' => bcrypt('admin123'), 
         'firstname'=>$faker->firstname,
         'lastname'=>$faker->lastname,
         'contact_number' => $faker->unique()->numberBetween(1000000000, 9999999999),
         'address'=>$faker->address,
         'city'=>$faker->city,
         'house_number'=>$faker->buildingNumber,
         'postal_code'=>$faker->buildingNumber,
         'is_active' => 1,
        'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
        'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
         'remember_token' => Str::random(10),
    ];
});
