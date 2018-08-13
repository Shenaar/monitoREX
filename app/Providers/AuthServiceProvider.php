<?php

namespace App\Providers;

use App\Models\Project;
use App\Policies\ProjectPolicy;
use App\Services\Auth\Contracts\Registrar;
use App\Services\Auth\UserRegistrar;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Project::class => ProjectPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $this->app->bind(Registrar::class, UserRegistrar::class);
    }
}
