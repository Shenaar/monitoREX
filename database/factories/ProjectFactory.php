<?php

use Faker\Generator as Faker;

/** @var $factory \Illuminate\Database\Eloquent\Factory */
$factory->define(App\Models\Project::class, function (Faker $faker) {
    return [
        'name'    => $faker->unique()->company,
        'api_key' => str_random(32),
        'domain'  => $faker->domainName,
    ];
});
