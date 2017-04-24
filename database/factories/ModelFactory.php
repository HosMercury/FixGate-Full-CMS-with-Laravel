<?php

$factory->define(/**
 * @param \Faker\Generator $faker
 * @return array
 */
    App\Material::class, function (Faker\Generator $faker) {
    return [
        'type' => $faker->randomElement(['material','asset']),
        'name' => $faker->sentence,
        'description' => $faker->text,
        'barcode' => $faker->isbn10,
        'manufacturer' => $faker->word,
        'location' => 8000,
        'SOH' => $faker->numberBetween(0,9999),
        'Price' => $faker->numberBetween(0,9999),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime
    ];
});


$factory->define(/**
 * @param \Faker\Generator $faker
 * @return array
 */
    App\Order::class, function (Faker\Generator $faker) {
    return [
        'number'=> $faker->numberBetween(1111,9999).'-'.$faker->numberBetween(10000000,99999999),
        'creator'=> $faker->numberBetween(1000,1005),
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'type' => 'A.C.',
        'priority' => $faker->randomElement(['Regular-72h','Important-48h','Urgent-24h','Crisis-psh']),
        'contact' => $faker->phoneNumber,
        'notes' => $faker->text,
        'location_id' => $faker->numberBetween(2000,3000),
        'key' => $faker->numberBetween(1111,9999),
        'created_at' => $faker->dateTimeThisMonth,
        'updated_at' => $faker->dateTimeThisMonth,
    ];
});