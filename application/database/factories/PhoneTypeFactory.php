<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Masters\PhoneType;
use Faker\Generator as Faker;

$factory->define(App\Models\Masters\PhoneType::class, function (Faker $faker) {
    return [
        'title' => 'Phone Type',
        'status' => 1,
        'created_by' => 1,
        'updated_by' => 1
    ];
});
