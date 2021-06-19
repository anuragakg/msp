<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Masters\Occupation;
use Faker\Generator as Faker;

$factory->define(App\Models\Masters\Occupation::class, function (Faker $faker) {
    return [
        'title' => 'Occupation',
        'status' => 1,
        'created_by' => 1,
        'updated_by' => 1
    ];
});
