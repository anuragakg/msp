<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Masters\Village;
use Faker\Generator as Faker;

$factory->define(App\Models\Masters\Village::class, function (Faker $faker) {
    return [
        'title' => 'Village',
        'code' => 'Code',
        'status' => 1,
        'created_by' => 1,
        'updated_by' => 1
    ];
});
