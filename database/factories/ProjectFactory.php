<?php

use App\Services\ProjectService;

use Faker\Generator as Faker;

$service = app(ProjectService::class);

/** @var $factory \Illuminate\Database\Eloquent\Factory */
$factory->define(App\Models\Project::class, function (Faker $faker) use ($service) {

    return [
        'title'   => $faker->unique()->company,
        'api_key' => $service->generateApiKey(),
        'domain'  => $faker->domainName,
    ];
});
