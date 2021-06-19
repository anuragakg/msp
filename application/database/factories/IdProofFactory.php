<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Masters\IdProof;
use Faker\Generator as Faker;

$factory->define(App\Models\Masters\IdProof::class, function (Faker $faker) {
    return [
        'title' => 'Id Proof',
        'status' => 1,
        'created_by' => 1,
        'updated_by' => 1
    ];
});
