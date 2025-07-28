<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use app\Contracts\TaskService;
use app\contracts\TaskContractService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TaskService::class, function (){
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
