<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Masters\Category;
use Faker\Generator as Faker;

$factory->define(App\Models\Masters\Category::class, function (Faker $faker) {
    return [
        'title' => 'Category',
        'status' => 1,
        'created_by' => 1,
        'updated_by' => 1
    ];
});
