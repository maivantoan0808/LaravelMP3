<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\CommentRepository::class, \App\Repositories\CommentRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PlaylistRepository::class, \App\Repositories\PlaylistRepositoryEloquent::class);
        //:end-bindings:
    }
}
