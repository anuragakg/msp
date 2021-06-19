<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Masters\OrgType;
use Faker\Generator as Faker;

$factory->define(App\Models\Masters\OrgType::class, function (Faker $faker) {
    return [
        'title' => 'Org Type',
        'status' => 1,
        'created_by' => 1,
        'updated_by' => 1
    ];
});
