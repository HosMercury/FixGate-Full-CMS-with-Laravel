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

//$factory->define(App\User::class, function (Faker\Generator $faker) {
//    return [
//        'name' => $faker->name,
//        'email' => $faker->email,
//        'id'=>$faker->numberBetween(1000,1100),
//        'location_id' => $faker->numberBetween(8707,8800),
//        'password' => bcrypt(str_random(10)),
//        'remember_token' => str_random(10)
//    ];
//});

//$factory->define(App\Role::class, function (Faker\Generator $faker) {
//    return [
//        'name' => $faker->randomElement([
//            'member','accountant','admin','super-admin'
//        ]),
//        'label' => $faker->sentence,
//    ];
//});

//$factory->define(App\Permission::class, function (Faker\Generator $faker) {
//    return [
//        'name' => $faker->randomElement([
//            'edit-order','show-order','delete-order'
//        ]),
//        'label' => $faker->sentence,
//    ];
//});


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