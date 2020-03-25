<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Colour;
use Faker\Generator as Faker;

$GLOBALS['colours'] = [
    'Blue',
    'Green',
    'Red',
    'Yellow',
    'Black',
    'White',
    'Transparent'
];

$factory->define(Colour::class, function (Faker $faker) {
    return [
        'colour' => $faker->unique()->randomElement($GLOBALS['colours'])
    ];
});
