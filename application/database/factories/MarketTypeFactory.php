<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Masters\MarketType;
use Faker\Generator as Faker;

$factory->define(App\Models\Masters\MarketType::class, function (Faker $faker) {
    return [
        'title' => 'Market Type',
        'status' => 1,
        'created_by' => 1,
        'updated_by' => 1
    ];
});
