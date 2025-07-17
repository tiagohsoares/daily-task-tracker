<?php

use App\Contracts\LoginService;
use App\Contracts\SocialiteContractService;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\ProviderCallbackController;
use App\Http\Controllers\ProviderController;
use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Console\Application;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
        
    Route::get('auth/{provider}/callback', function (string $provider) {
        try {
        if (!in_array($provider, ['github', 'google'])){
            throw new \InvalidArgumentException("Driver não é permitido.");
        }
        $service = app()->make(LoginService::class, ['driver' => $provider]);
        return $service->handleProviderCallback($provider);

        } catch (\Throwable $e) {
            $e->getMessage();
        }
    });
        
    Route::get('auth/{provider}/redirect', function ( string $provider) {
        try {
            if (!in_array($provider, ['github', 'google'])){
                throw new \InvalidArgumentException("Driver não é permitido.");
            }
            $service = app()->make(LoginService::class, ['driver' => $provider]);
            return $service->redirectToDriver($provider);

        } catch (\Throwable $e) {
            abort('404', 'Driver não suportado');
        }
       
    });
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
    
    
});

