<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
// Importing the roles middleware
use App\Http\Middleware\Admin;
use App\Http\Middleware\EventAdmin;
use App\Http\Middleware\Panelis;
use App\Http\Middleware\User;
use App\Http\Middleware\TrackVisits;
use Mews\Captcha\Facades\Captcha;

// Importing the email verification middleware
use App\Http\Middleware\EnsureEmailIsVerified;
use App\Http\Middleware\RedirectIfAuthenticated;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        ]);

        // Adding multi roles authentication (middleware class)
        $middleware->alias([
            'admin' => Admin::class,
            'eventadmin' => EventAdmin::class,
            'user' => User::class,
            'panelis' => Panelis::class,
            // Adding the verified middleware
            'verified' => EnsureEmailIsVerified::class,
            'google' => RedirectIfAuthenticated::class,
            'track.visits' => TrackVisits::class,
            'captcha' => \Mews\Captcha\Middleware\Captcha::class,
        ]);

        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
