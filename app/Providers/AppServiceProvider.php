<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\LoginService;
use App\Contracts\SocialiteContractService;
use App\Models\Category;
use Illuminate\Console\Application;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TaskService::class, function (){
            return $this->app->make(TaskContractService::class);
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
