<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Task;
use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'parent_id' => $faker->numberBetween(1, 5),
        'user_id' => $faker->numberBetween(1, 5),
        'title' => $faker->sentence(),
        'points' => $faker->numberBetween(5, 25),
        'is_done' => $faker->boolean,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ];
});
