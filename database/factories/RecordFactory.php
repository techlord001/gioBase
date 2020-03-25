<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Record;
use App\Artist;
use Faker\Generator as Faker;

$factory->define(Record::class, function (Faker $faker) {
    $artists = Artist::pluck('id')->toArray();

    return [
        'title' => $faker->sentence(),
        'artist_id' => $faker->randomElement($artists),
        'released'=> $faker->date()
    ];
});
