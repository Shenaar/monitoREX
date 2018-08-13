<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Contracts\Hashing\Hasher $hasher */
$hasher = app(\Illuminate\Contracts\Hashing\Hasher::class);

/** @var $factory \Illuminate\Database\Eloquent\Factory */
$factory->define(App\Models\User::class, function (Faker $faker) use ($hasher) {

    $email = $faker->unique()->email;

    return [
        'email'    => $email,
        'password' => $hasher->make($faker->password()),
        'name'     => $faker->name,
    ];
});
