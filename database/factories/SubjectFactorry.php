<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Subject;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Model;

$factory->define(Subject::class, function (Faker $faker) {
    return [
        'name' => $faker->text(100),
        'description' => $faker->text(500),
        'module_id' => random_int(1, 7)
    ];
});
