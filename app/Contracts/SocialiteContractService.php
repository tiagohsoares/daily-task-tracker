<?php

namespace App\Contracts;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialiteContractService implements LoginService
{
    public function __construct(private array $config) {}

    public function redirectToDriver(string $provider)
    {
        try {
            if (! in_array($provider, $this->config)) {
                throw new \InvalidArgumentException('Driver não é permitido.');
            }
        } catch (\Throwable $th) {
            return redirect('/login')->with('error', '{provider} authentication failed.');
        }

        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback(string $provider): RedirectResponse
    {
        try {
            if (! in_array($provider, $this->config)) {
                throw new \InvalidArgumentException('Driver não é permitido.');
            }
            $user = Socialite::driver($provider)->user();
        } catch (\Throwable $th) {
            return redirect('/login')->with('error', '{provider} authentication failed.');
        }

        $existingUser = User::where('email', $user->email)->first();

        if ($existingUser) {

            $existingUser->update([

                'provider' => $provider,
                'provider_token' => $user->token,
                'provider_refresh_token' => $user->refreshToken,

            ]);

            Auth::login($existingUser);

        } else {
            $newUser = User::updateOrCreate([
                'email' => $user->email,
            ], [
                'name' => $user->name,
                'password' => bcrypt(Str::random(16)),
                'provider' => $user->provider,
                'provider_token' => $user->token,
                'provider_refresh_token' => $user->refreshToken,
            ]);

            Auth::login($newUser);
        }

        return redirect()->intended('/dashboard');
    }
}
