<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Masters\WarehousePremises;
use Faker\Generator as Faker;

$factory->define(App\Models\Masters\WarehousePremises::class, function (Faker $faker) {
    return [
        'title' => 'Warehouse Premises',
        'status' => 1,
        'created_by' => 1,
        'updated_by' => 1
    ];
});
