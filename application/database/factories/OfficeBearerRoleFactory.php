<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Masters\OfficeBearerRole;
use Faker\Generator as Faker;

$factory->define(App\Models\Masters\OfficeBearerRole::class, function (Faker $faker) {
    return [
        'title' => 'Office Bearer Role',
        'status' => 1,
        'created_by' => 1,
        'updated_by' => 1
    ];
});
