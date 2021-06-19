<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Masters\Regulation;
use Faker\Generator as Faker;

$factory->define(App\Models\Masters\Regulation::class, function (Faker $faker) {
    return [
        'title' => 'Regulation',
        'status' => 1,
        'created_by' => 1,
        'updated_by' => 1
    ];
});
