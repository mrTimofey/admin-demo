<?php

use Faker\Generator as Faker;

/**
 * @var \Illuminate\Database\Eloquent\Factory $factory
 */

$factory->define(App\Models\Post::class, function(Faker $faker) {
	$created = $faker->dateTimeBetween('-1 year');

	static $categories, $images;

	if (!$categories) {
		$categories = \App\Models\PostCategory::all();
		$images = \MrTimofey\LaravelAioImages\ImageModel::all();
	}

	return [
		'title' => $faker->catchPhrase,
		'created_at' => $created,
		'updated_at' => $faker->boolean(80) ? $created :
			(clone $created)->add(date_interval_create_from_date_string('+' . random_int(1, 10) . ' days')),
		'summary' => $faker->text,
		'content' => '<p>' . $faker->text . '</p><p>' . $faker->text . '</p>',
		'meta' => [
			'title' => $faker->catchPhrase,
			'description' => $faker->text,
			'keywords' => implode(', ', $faker->words(random_int(2, 5)))
		],
		'category_id' => $categories->random()->getKey(),
		'image_id' => $faker->boolean(80) ? $images->random()->getKey() : null
	];
});
