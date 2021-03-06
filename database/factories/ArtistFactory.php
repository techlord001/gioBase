<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Artist;
use App\Label;
use Faker\Generator as Faker;

$factory->define(Artist::class, function (Faker $faker) {
    $labels = Label::pluck('id')->toArray();

    return [
        'name' => $faker->unique()->name(),
        'description' => $faker->text(),
        'homepage' => $faker->optional()->url
    ];
});
