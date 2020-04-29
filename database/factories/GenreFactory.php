<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Genre;
use Faker\Generator as Faker;

$GLOBALS['genres'] = [
    'Eccojams',
    'Utopian Virtual',
    'Faux-Utopian',
    'Hypnagogic Drift',
    'Broken Transmission',
    'Mallsoft',
    'Futurevisions',
    'Late Night Lo-Fi',
    'VHS Pop',
    'Future Funk',
    'Vapormeme',
    'Vaportrap'
];

$factory->define(Genre::class, function (Faker $faker) {
    return [
        'genre' => $faker->unique()->randomElement($GLOBALS['genres'])
    ];
});
