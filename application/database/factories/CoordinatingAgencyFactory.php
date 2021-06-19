<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Masters\CoordinatingAgency;
use Faker\Generator as Faker;

$factory->define(App\Models\Masters\CoordinatingAgency::class, function (Faker $faker) {
    return [
        'title' => 'Coordinating Agency',
        'status' => 1,
        'created_by' => 1,
        'updated_by' => 1
    ];
});
