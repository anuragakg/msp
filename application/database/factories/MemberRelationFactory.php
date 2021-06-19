<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Masters\MemberRelation;
use Faker\Generator as Faker;

$factory->define(App\Models\Masters\MemberRelation::class, function (Faker $faker) {
    return [
        'title' => 'Member Relation',
        'status' => 1,
        'created_by' => 1,
        'updated_by' => 1
    ];
});
