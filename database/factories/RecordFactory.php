<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Record;
use App\Artist;
use App\Format;
use App\Colour;
use Faker\Generator as Faker;

$factory->define(Record::class, function (Faker $faker) {
    $artists = Artist::pluck('id')->toArray();
    $formats = Format::pluck('id')->toArray();
    $colours = Colour::pluck('id')->toArray();

    return [
        'name' => $faker->sentence(),
        'artist_id' => $faker->randomElement($artists),
        'format_id' => $faker->optional()->randomElement($formats),
        'colour_id' => $faker->optional()->randomElement($colours),
        'released'=> $faker->date()
    ];
});
