<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Format;
use Faker\Generator as Faker;

$GLOBALS['formats'] = [
    '7" Vinyl',
    '12" Vinyl',
    'Cassette',
    'Digital'
];

$factory->define(Format::class, function (Faker $faker) {
    return [
        'format' => $faker->unique()->randomElement($GLOBALS['formats'])
    ];
});
