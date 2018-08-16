<?php

namespace App\Providers;

use App\Services\Reporter\Reporter;
use App\Services\Reporter\SimpleReporter;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Reporter::class, SimpleReporter::class);
    }
}
