<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Label;
use Faker\Generator as Faker;

$factory->define(Label::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->company,
        'location' => $faker->city . ', ' . $faker->country,
        'description' => $faker->optional()->text
    ];
});
