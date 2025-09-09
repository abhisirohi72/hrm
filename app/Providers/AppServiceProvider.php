<?php

namespace App\Providers;

use App\Services\CurlService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //Binding
        $this->app->bind(CurlService::class, function($app){
            return new CurlService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
