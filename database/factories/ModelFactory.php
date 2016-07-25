<?php
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10)
    ];
});

$factory->define(App\Worker::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'role' => $faker->randomElement(['labor','external','technician']),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime
    ];
});

$factory->define(App\Assignment::class, function (Faker\Generator $faker) {
    return [
        'status' => 'New',
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime
    ];
});

$factory->define(App\Order::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->text,
        'description' => $faker->text,
        'trade' => $faker->word,
        'priority' => $faker->randomElement(['Regular-72hr','Important-48hr','Urgent-24hr','Crisis-Now']),
        'contact' => $faker->phoneNumber,
        'notes' => $faker->text,
        'entry' => $faker->time('H:i'),
        'exit' => $faker->time('H:i'),
        'close_key' => $faker->numberBetween(1111,9999),
        'created_at' => $faker->dateTimeThisMonth,
        'updated_at' => $faker->dateTimeThisMonth
    ];
});

