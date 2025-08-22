<?php

namespace App\Contracts;

use Illuminate\Http\RedirectResponse;

interface LoginService
{
    public function redirectToDriver(string $provider);

    public function handleProviderCallback(string $provider): RedirectResponse;
}
