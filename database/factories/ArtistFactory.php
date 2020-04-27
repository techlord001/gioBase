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
        'label_id' => $faker->randomElement($labels),
        'homepage' => $faker->optional()->url
    ];
});
