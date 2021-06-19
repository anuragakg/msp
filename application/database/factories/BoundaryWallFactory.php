<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Masters\BoundaryWall;
use Faker\Generator as Faker;

$factory->define(App\Models\Masters\BoundaryWall::class, function (Faker $faker) {
    return [
        'title' => 'Boundary Wall',
        'status' => 1,
        'created_by' => 1,
        'updated_by' => 1
    ];
});
