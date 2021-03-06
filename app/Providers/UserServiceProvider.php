<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            \App\Repository\UserRepositoryInterface::class,
            \App\Repository\UserRepository::class
        );

    }

    public function boot()
    {
        //
    }
}
