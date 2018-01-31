<?php

namespace App\Providers;

use App\Services\InternetMovieDBService;
use App\Services\MovieService;
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
        $this->app->singleton(InternetMovieDBService::class, function() {
            return new InternetMovieDBService(config('imdb.api_key'));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->alias(InternetMovieDBService::class, MovieService::class);
    }
}
