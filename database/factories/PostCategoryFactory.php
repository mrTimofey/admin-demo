<?php

use Faker\Generator as Faker;

/**
 * @var \Illuminate\Database\Eloquent\Factory $factory
 */

$factory->define(App\Models\PostCategory::class, function(Faker $faker) {
	return [
		'name' => $faker->catchPhrase,
		'sort' => random_int(1, 1000)
	];
});
