<?php

use Faker\Generator as Faker;
use App\Http\TkTk\SeederExtension;

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


$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name'              => $faker->name,
        'lastname'          => $faker->lastName,
        'email'             => $faker->unique()->safeEmail,
        'password'          => bcrypt('secret'),
        'api_token'         => str_random(60),
        'remember_token'    => str_random(10),
    ];
});

$factory->define(App\UserProfile::class, function (Faker $faker) {
    return [
        'username'          => $faker->userName,
        'birthdate'         => $faker->date($format = 'Y-m-d', $max = 'now'),
        'gender'            => $faker->numberBetween(0,1) == 0 ? 'male' : 'female',
        'langcode'          => $faker->numberBetween(0,1) == 0 ? 'en' : 'es',
        'addrss'            => $faker->address,
        'phone'             => $faker->e164PhoneNumber,
        'zipcode'           => $faker->numberBetween(100, 2000),

        //FK
        'user'              => $faker->unique()->numberBetween(3, 32),      // 32 # of user to be generated
        'city'              => $faker->numberBetween(1,40),
    ];
});

$factory->define(App\Country::class, function (Faker $faker) {
    return [
        'name'              => $faker->unique()->randomElement(SeederExtension::$countries),
    ];
});

$factory->define(App\City::class, function (Faker $faker) {
    return [
        'name'              => $faker->city,
        'country'           => $faker->numberBetween(1, 20),              // 20 # of countries to be generated
    ];
});

$factory->define(App\Raffle::class, function (Faker $faker) {
    return [
        'id'                => \App\Http\TkTk\CodesGenerator::newRaffleId(),
        'owner'             => $faker->numberBetween(1, 32),
        'category'          => $faker->numberBetween(1, 5),
        'status'            => 1,
        'location'          => $faker->numberBetween(1, 5),
        'title'             => SeederExtension::$obj2sell[rand(0,10)].' '.SeederExtension::$brand[rand(0,10)].' color '.SeederExtension::$color[rand(0,8)],
        'description'       => $faker->text(255),
        'price'             => $faker->numberBetween(30, 1000),
    ];
});
