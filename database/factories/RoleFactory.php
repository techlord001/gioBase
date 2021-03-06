<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Role;
use Faker\Generator as Faker;

$GLOBALS['roles'] = [
    'Member',
    'Contributor',
    'Admin',
    'Master'
];

$factory->define(Role::class, function (Faker $faker) {
    return [
        'role' => $faker->unique()->randomElement($GLOBALS['roles'])
    ];
});
