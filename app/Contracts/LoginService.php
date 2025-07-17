<?php

namespace App\Contracts;

interface LoginService 

{
    public function redirectToDriver(string $provider);
    public function handleProviderCallback(string $provider);

}
