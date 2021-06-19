<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Masters\Vehicle;
use Faker\Generator as Faker;

$factory->define(App\Models\Masters\Vehicle::class, function (Faker $faker) {
    return [
        'title' => 'Vehicle',
        'status' => 1,
        'created_by' => 1,
        'updated_by' => 1
    ];
});
