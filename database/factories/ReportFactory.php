<?php

use App\Models\Report;

use Faker\Generator as Faker;

$exceptions = [
    Illuminate\Database\Eloquent\ModelNotFoundException::class,
    Illuminate\Database\Eloquent\MassAssignmentException::class,
    Illuminate\Database\Eloquent\RelationNotFoundException::class,
    Illuminate\Routing\Exceptions\UrlGenerationException::class,
];

function getBacktrace()
{
    $result = '';
    collect(debug_backtrace())
        ->filter(function ($item) {
            $function = array_get($item, 'function');
            $file     = array_get($item, 'file');
            $class    = array_get($item, 'class');

            if (!$function) {
                return false;
            }

            return $file || $class;
        })
        ->each(function ($item) use (&$result) {
            $function = array_get($item, 'function');
            $file     = array_get($item, 'file');
            $line     = array_get($item, 'line');
            $class    = array_get($item, 'class');

            $result .= $result ? PHP_EOL : '';
            $result .= ($file ? : $class) . '::' . $function . '()'
                . ($line ? ':' . $item['line'] : '');
        });

    return $result;
}

$factory->define(Report::class, function (Faker $faker) use ($exceptions) {
    return [
        'class' => $faker->randomElement($exceptions),
        'file' => '/home/vagrant/monitorex/vendor/laravel/framework/src/Illuminate/Routing/Router.php',
        'line' => 963,
        'message' => $faker->sentence,
        'trace' => getBacktrace(),
        'url' => $faker->url,
        'created_at' => $faker->dateTimeBetween('-1 week'),
    ];
});
