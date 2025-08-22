<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\LoginService;

class ProviderController extends Controller
{
    protected readonly array $provider;

    public function callback(string $provider)
    {

        $service = app()->make(LoginService::class, ['driver' => $provider]);

        return $service->handleProviderCallback($provider);

    }

    public function redirect(string $provider)
    {

        $service = app()->make(LoginService::class, ['driver' => $provider]);

        return $service->redirectToDriver($provider);

    }
}
