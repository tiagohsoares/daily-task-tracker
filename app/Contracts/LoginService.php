<?php

namespace App\Contracts;

interface LoginService 

{
    public function redirectToDriver($provider);
    public function handleProviderCallback($provider);

}
