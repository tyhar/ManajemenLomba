<?php

use Laravel\Fortify\Features;
use Laravel\Fortify\Http\Controllers\VerifyEmailController;

return [

    'guard' => 'web',

    'passwords' => 'users',

    'username' => 'email',

    'email' => 'email',

    'home' => '/dashboard',

    'prefix' => '',

    'middleware' => ['web'],

    'auth_middleware' => 'auth',

    'limiters' => [
        'login' => 'login',
        'two-factor' => 'two-factor',
    ],

    'paths' => [
        'login' => '/login',
        'logout' => '/logout',
        'password.request' => '/forgot-password',
        'password.reset' => '/reset-password',
        'password.email' => '/forgot-password',
        'password.update' => '/reset-password',
        'register' => '/register',
        'verification.notice' => '/email/verify',
        'verification.verify' => '/email/verify/{id}/{hash}',
        'verification.send' => '/email/verification-notification',
        'user-profile-information.update' => '/user/profile-information',
        'user-password.update' => '/user/password',
        'two-factor.login' => '/two-factor-challenge',
        'two-factor.enable' => '/user/two-factor-authentication',
        'two-factor.disable' => '/user/two-factor-authentication',
        'two-factor.qr' => '/user/two-factor-qr-code',
        'two-factor.secret' => '/user/two-factor-secret-key',
        'two-factor.recovery-codes' => '/user/two-factor-recovery-codes',
    ],

    'features' => [
        Features::registration(),
        Features::resetPasswords(),
        Features::emailVerification(),
        Features::updateProfileInformation(),
        Features::updatePasswords(),
        Features::twoFactorAuthentication([
            'confirmPassword' => true,
        ]),
    ],

];
