<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Masters\WarehouseCondition;
use Faker\Generator as Faker;

$factory->define(App\Models\Masters\WarehouseCondition::class, function (Faker $faker) {
    return [
        'title' => 'Warehouse Condition',
        'status' => 1,
        'created_by' => 1,
        'updated_by' => 1
    ];
});
