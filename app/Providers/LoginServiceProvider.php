<?php

namespace App\Providers;

use App\Contracts\LoginService;
use App\Contracts\SocialiteContractService;
use Illuminate\Support\ServiceProvider;

class LoginServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(LoginService::class, function (){
            return $this->app->make(SocialiteContractService::class, 
            [ 'config' => ['github', 'google'] ] );
       });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
