<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TaskServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            \App\Repository\TaskRepositoryInterface::class,
            \App\Repository\TaskRepository::class
        );

    }

    public function boot()
    {
        //
    }
}
