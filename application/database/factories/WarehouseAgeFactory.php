<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Masters\WarehouseAge;
use Faker\Generator as Faker;

$factory->define(App\Models\Masters\WarehouseAge::class, function (Faker $faker) {
    return [
        'title' => 'Warehouse Age',
        'status' => 1,
        'created_by' => 1,
        'updated_by' => 1
    ];
});
