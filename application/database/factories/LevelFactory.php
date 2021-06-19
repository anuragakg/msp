<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Masters\Level;
use Faker\Generator as Faker;

$factory->define(App\Models\Masters\Level::class, function (Faker $faker) {
    return [
        'title' => 'Level',
        'slug' => 'Slug',
        'description' => 'Description',
        'status' => 1,
        'created_by' => 1,
        'updated_by' => 1
    ];
});
