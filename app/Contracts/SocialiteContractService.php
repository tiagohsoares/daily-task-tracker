<?php

namespace App\Contracts;

use App\Contracts\LoginService;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

readonly class SocialiteContractService implements LoginService {


    public function __construct(
        private array $config ){
        }

    public function redirectToDriver($provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }
    
    public function handleProviderCallback($provider)
    {
        $providerUser = Socialite::driver($provider)->stateless()->user();
        
        $user = User::UpdateOrCreate()([
            'google_id'                     => $providerUser->id,
        ], [ 
            'name'                          => $providerUser->name,
            'provider'                      => $providerUser,
            'email'                         => $providerUser->email,
            '{$provider}_token'             => $providerUser->token,
            '{$provider}_refresh_token'     => $providerUser->refreshToken,
            ]);

        
        auth()->login($user);

        return redirect('/dashboard');
    }
}