<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Masters\Commodity;
use Faker\Generator as Faker;

$factory->define(App\Models\Masters\Commodity::class, function (Faker $faker) {
    return [
        'title' => 'Commodity',
        'status' => 1,
        'created_by' => 1,
        'updated_by' => 1
    ];
});
