<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Masters\Year;
use Faker\Generator as Faker;

$factory->define(App\Models\Masters\Year::class, function (Faker $faker) {
    return [
        'title' => 'Year',
        'status' => 1,
        'created_by' => 1,
        'updated_by' => 1
    ];
});
