<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\LoginService;
use App\Contracts\SocialiteContractService;
use Illuminate\Console\Application;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
       $this->app->bind(LoginService::class, function ($app){
            return $this->app->make(SocialiteContractService::class, 
            [ 'config' => ['github', 'google'] ] );
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
