<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Masters\Transportation;
use Faker\Generator as Faker;

$factory->define(App\Models\Masters\Transportation::class, function (Faker $faker) {
    return [
        'title' => 'Transportation',
        'status' => 1,
        'created_by' => 1,
        'updated_by' => 1
    ];
});
