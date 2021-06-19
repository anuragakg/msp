<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Masters\AccessRoad;
use Faker\Generator as Faker;

$factory->define(App\Models\Masters\AccessRoad::class, function (Faker $faker) {
    return [
        'title' => 'Access Road',
        'status' => 1,
        'created_by' => 1,
        'updated_by' => 1
    ];
});
