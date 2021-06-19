<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Masters\BuiltUpArea;
use Faker\Generator as Faker;

$factory->define(App\Models\Masters\BuiltUpArea::class, function (Faker $faker) {
    return [
        'title' => 'Built Up Area',
        'status' => 1,
        'created_by' => 1,
        'updated_by' => 1
    ];
});
