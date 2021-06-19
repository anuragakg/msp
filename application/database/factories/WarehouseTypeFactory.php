<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Masters\WarehouseType;
use Faker\Generator as Faker;

$factory->define(App\Models\Masters\WarehouseType::class, function (Faker $faker) {
    return [
        'title' => 'Warehouse Type',
        'status' => 1,
        'created_by' => 1,
        'updated_by' => 1
    ];
});
