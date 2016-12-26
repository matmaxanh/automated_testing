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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Entities\Models\Post;
use Faker\Generator;

$factory->define(Post::class, function (Generator $faker) {

    return [
        'title' => $faker->sentence(),
        'slug' => $faker->slug(),
        'body' => $faker->text(),
        'author' => $faker->unique()->numberBetween(1, 50)
    ];
});
