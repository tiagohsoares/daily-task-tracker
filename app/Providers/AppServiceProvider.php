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
        //
    }
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
