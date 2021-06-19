<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Masters\MarketRegulation;
use Faker\Generator as Faker;

$factory->define(App\Models\Masters\MarketRegulation::class, function (Faker $faker) {
    return [
        'title' => 'Market Regulation',
        'status' => 1,
        'created_by' => 1,
        'updated_by' => 1
    ];
});
