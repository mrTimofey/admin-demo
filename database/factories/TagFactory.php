<?php

use Faker\Generator as Faker;

/**
 * @var \Illuminate\Database\Eloquent\Factory $factory
 */

$factory->define(App\Models\Tag::class, function(Faker $faker) {
	return [
		'name' => $faker->unique()->word,
		'sort' => random_int(1, 1000)
	];
});
