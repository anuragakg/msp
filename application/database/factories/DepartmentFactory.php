<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Masters\Department;
use Faker\Generator as Faker;

$factory->define(App\Models\Masters\Department::class, function (Faker $faker) {
    return [
        'title' => 'Department',
        'status' => 1,
        'created_by' => 1,
        'updated_by' => 1
    ];
});
