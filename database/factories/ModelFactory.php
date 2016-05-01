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

$factory->define(App\Models\Invoice::class, function (Faker\Generator $faker) {
	return [
		'bill_to' => $faker->address,
		'taxes' => $faker->numberBetween(100, 10000),
	];
});

$factory->define(App\Models\InvoiceLine::class, function (Faker\Generator $faker) {
	return [
		'description' => $faker->sentence,
		'hourly_price' => $faker->numberBetween(1500, 6000),
		'hours' => $faker->numberBetween(1, 60)
	];
});