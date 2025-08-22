<?php

namespace App\Providers;

use app\contracts\TaskContractService;
use app\Contracts\TaskService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TaskService::class, function () {
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
