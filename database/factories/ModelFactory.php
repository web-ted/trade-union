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
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Worker::class, function (Faker\Generator $faker) {
    return [
        'active' => true,
        'registration_number' => $faker->numberBetween(1, 400),
        'registered_at' => $faker->date(),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'father_name' => $faker->firstName,
        'birth_date' => $faker->date('Y-m-d'),
        'id_card' => $faker->creditCardNumber,
        'phone' => $faker->phoneNumber,
        'mobile_phone' => $faker->phoneNumber,
        'email' => $faker->email,
        'address' => $faker->address,
        'region' => $faker->city,
        'city' => $faker->city,
        'hire_date' => $faker->date('Y-m-d'),
        'insurance_number' => $faker->creditCardNumber,
        'comment' => $faker->text(20),
        'enterprise_id' => $faker->numberBetween(1, 5),
        'enterprise_id' => $faker->numberBetween(1, 5),
        'specialty_id' => $faker->numberBetween(1, 5),
//        'created_at' => date("Y-m-d H:i:s"),
        'created_at' => time(),
//        'updated_at' => date("Y-m-d H:i:s"),
        'updated_at' => time()
    ];
});

$factory->define(App\Enterprise::class, function(Faker\Generator $faker) {
    return [
        'name' => $faker->company,
        'address' => $faker->streetAddress,
        'region' => $faker->city,
        'city' => $faker->city,
        'phone' => $faker->phoneNumber,
        'fax' => $faker->phoneNumber,
        'email' => $faker->email,
        'founded' => $faker->year,
        'workers_number' => $faker->numberBetween(10, 250),
        'business_activity' => $faker->companySuffix,
    ];
});

//$factory->define(App\Specialty::class, function(Faker\Generator) {
//    return [
//
//    ];
//});