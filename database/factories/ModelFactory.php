<?php

$factory->define(App\Material::class, function (Faker\Generator $faker) {
    return [
        'type' => $faker->randomElement(['material','asset']),
        'name' => $faker->sentence,
        'description' => $faker->text,
        'barcode' => $faker->isbn10,
        'manufacturer' => $faker->word,
        'store' => $faker->randomElement(['RYD','JED','MEC','ABHA','DAM']),
        'substore' => $faker->word,
        'SOH' => $faker->numberBetween(0,9999),
        'Price' => $faker->numberBetween(0,9999),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime
    ];
});


$factory->define(App\Location::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->numberBetween(2000,3000),
        'name'=>$faker->name,
        'city'=>$faker->randomElement(['RYD','JED','MED','MEC','ABHA','DAM']),
        'address'=>$faker->address,
        'latitude'=>$faker->latitude,
        'longitude'=>$faker->longitude,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime
    ];
});

$factory->define(App\Order::class, function (Faker\Generator $faker) {
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