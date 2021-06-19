<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Masters\Periodicity;
use Faker\Generator as Faker;

$factory->define(App\Models\Masters\Periodicity::class, function (Faker $faker) {
    return [
        'title' => 'Periodicity',
        'status' => 1,
        'created_by' => 1,
        'updated_by' => 1
    ];
});
