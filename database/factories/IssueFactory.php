<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Issue;
use Faker\Generator as Faker;

$factory->define(Issue::class, function (Faker $faker) {
    return [
        'title' => $faker->realText( 100),
        'content' => $faker->text(1000),
        'subject_id' => random_int(1, 30),
        'user_id' => random_int(2,11)
    ];
});
