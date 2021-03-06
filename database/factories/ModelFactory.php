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
		'name'           => $faker->name,
		'email'          => $faker->email,
		'password'       => bcrypt(str_random(10)),
		'remember_token' => str_random(10),
	];
});

$factory->define(App\Worker::class, function (Faker\Generator $faker) {
	return [
		'active'              => 1,
		'registration_number' => $faker->unique()->randomNumber(3),
		'registered_at'       => $faker->date('c', "3 weeks ago"),
		'first_name'          => $faker->firstName,
		'last_name'           => $faker->lastName,
		'father_name'         => $faker->firstName,
		'birth_date'          => $faker->date('c', "18 year ago"),
		'id_card'             => $faker->creditCardNumber,
		'phone'               => $faker->phoneNumber,
		'mobile_phone'        => $faker->phoneNumber,
		'email'               => $faker->email,
		'address'             => $faker->streetAddress,
		'postal_code'         => $faker->postcode,
		'region'              => $faker->citySuffix,
		'city'                => $faker->city,
		'hire_date'           => $faker->date('c', "10 years ago"),
		'insurance_number'    => $faker->uuid,
		'comment'             => $faker->realText(20),
		'enterprise_id'       => $faker->numberBetween(1, 10),
		'specialty_id'        => $faker->numberBetween(1, 4),
	];
});

$factory->define(App\Enterprise::class, function (Faker\Generator $faker) {
	return [
		'name'              => $faker->company,
		'address'           => $faker->streetAddress,
		'region'            => $faker->address,
		'phone'             => $faker->phoneNumber,
		'fax'               => $faker->phoneNumber,
		'email'             => $faker->companyEmail,
		'city'              => $faker->city,
		'founded'           => $faker->date('Y-m-d', "5 years ago"),
		'workers_number'    => $faker->randomNumber(2),
		'owners'            => $faker->firstName . ' ' . $faker->lastName,
		'business_activity' => 'Software House',
	];
});

$factory->define(App\Specialty::class, function (Faker\Generator $faker) {
	return [
		'name'        => $faker->colorName,
		'description' => $faker->realText(30)
	];
});
