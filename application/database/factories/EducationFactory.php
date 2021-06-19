<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Masters\Education;
use Faker\Generator as Faker;

$factory->define(App\Models\Masters\Education::class, function (Faker $faker) {
    return [
        'title' => 'Education',
        'status' => 1,
        'created_by' => 1,
        'updated_by' => 1
    ];
});
