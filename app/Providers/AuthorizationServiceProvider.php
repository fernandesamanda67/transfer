<?php

namespace App\Providers;

use App\Services\Contracts\AuthorizationServiceContract;
use App\Services\AuthorizationService;
use Illuminate\Support\ServiceProvider;

class AuthorizationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            AuthorizationServiceContract::class,
            AuthorizationService::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
