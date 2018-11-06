<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\CategoryRepository',
            'App\Repositories\CategoryRepositoryEloquent'
        );

        $this->app->bind(
            'App\Repositories\UserRepository',
            'App\Repositories\UserRepositoryEloquent'
        );

        $this->app->bind(
            'App\Repositories\SongRepository',
            'App\Repositories\SongRepositoryEloquent'
        );

        $this->app->bind(
            'App\Repositories\AlbumRepository',
            'App\Repositories\AlbumRepositoryEloquent'
        );

        $this->app->bind(
            'App\Repositories\CommentRepository',
            'App\Repositories\CommentRepositoryEloquent'
        );

        $this->app->bind(
            'App\Repositories\PlaylistRepository',
            'App\Repositories\PlaylistRepositoryEloquent'
        );
    }
}
