<?php

namespace App\Providers;

use App\Repositories\Contracts\TransactionRepositoryContract;
use App\Repositories\TransactionRepository;
use Illuminate\Support\ServiceProvider;

class TransactionRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            TransactionRepositoryContract::class,
            TransactionRepository::class
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