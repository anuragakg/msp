<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Masters\Designation;
use Faker\Generator as Faker;

$factory->define(App\Models\Masters\Designation::class, function (Faker $faker) {
    return [
        'title' => 'Designation',
        'status' => 1,
        'created_by' => 1,
        'updated_by' => 1
    ];
});
