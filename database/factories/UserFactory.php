<?php

use Faker\Generator as Faker;

/** @var $factory \Illuminate\Database\Eloquent\Factory */
$factory->define(App\Models\User::class, function (Faker $faker) {

    $email = $faker->unique()->email;

    return [
        'email'    => $email,
        'password' => $faker->password(),
        'name'     => $faker->name,
    ];
});
