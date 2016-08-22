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
        'id'=>$faker->numberBetween(1010,1020),
        'location_id' => $faker->numberBetween(2000,2005),
        'manager_id' => $faker->numberBetween(1005,1010),
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10)
    ];
});

$factory->define(App\Role::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->randomElement([
            'user','SV','AM','GROM','accountant','admin','super-admin'
        ]),
        'label' => $faker->sentence,
    ];
});

$factory->define(App\Permission::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->randomElement([
            'edit','show','delete'
        ]),
        'label' => $faker->sentence,
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

$factory->define(App\Assignment::class, function (Faker\Generator $faker) {
    return [
        'order_id' =>$faker->numberBetween(1000,1005),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime
    ];
});

$factory->define(App\Location::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->numberBetween(2000,2005),
        'name'=>$faker->name,
        'city'=>$faker->randomElement(['RYD','JED','MED','MEC','ABHA','DAM']),
        'address'=>$faker->address,
        'latitude'=>$faker->latitude,
        'longitude'=>$faker->longitude,
        'manager_id' => $faker->numberBetween(1000,1005),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime
    ];
});

$factory->define(App\Order::class, function (Faker\Generator $faker) {
    return [
        'user_id'=> $faker->numberBetween(1000,1005),
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'type' => $faker->word,
        'priority' => $faker->randomElement(['Regular-72h','Important-48h','Urgent-24h','Crisis-psh']),
        'contact' => $faker->phoneNumber,
        'notes' => $faker->text,
        'entry' => $faker->time('H:i'),
        'exit' => $faker->time('H:i'),
        'location_id' => $faker->numberBetween(2000,2005),
        'close_key' => $faker->numberBetween(1111,9999),
        'created_at' => $faker->dateTimeThisMonth,
        'updated_at' => $faker->dateTimeThisMonth,
    ];
});