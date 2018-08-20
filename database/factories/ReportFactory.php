<?php

use App\Models\Report;

use Faker\Generator as Faker;

$exceptions = [
    Illuminate\Database\Eloquent\ModelNotFoundException::class,
    Illuminate\Database\Eloquent\MassAssignmentException::class,
    Illuminate\Database\Eloquent\RelationNotFoundException::class,
    Illuminate\Routing\Exceptions\UrlGenerationException::class,
];

$factory->define(Report::class, function (Faker $faker) use ($exceptions) {

    return [
        'class' => $faker->randomElement($exceptions),
        'file' => '/home/vagrant/monitorex/vendor/laravel/framework/src/Illuminate/Routing/Router.php',
        'line' => 963,
        'message' => $faker->sentence,
        'trace' => 'trace',
        'created_at' => $faker->dateTimeBetween('-1 week'),
    ];
});
