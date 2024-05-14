<?php

namespace App\Providers;

use App\Models\Market;
use App\Models\User;
use App\Repositories\MarketRepositories\MarketRepositoryInterface;
use App\Repositories\UserRepositories\UserRepositoryInterface;
use App\Repositories\MarketRepositories\MarketRepository;
use App\Repositories\UserRepositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(UserRepositoryInterface::class, function($app) { return new UserRepository(new User()); });
        $this->app->bind(MarketRepositoryInterface::class, function($app) { return new MarketRepository(new Market()); });

    }
}
