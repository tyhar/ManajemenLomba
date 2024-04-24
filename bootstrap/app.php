<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
//importing the roles middleware 
use App\Http\Middleware\Admin;
use App\Http\Middleware\EventAdmin;
use App\Http\Middleware\Panelis;
use App\Http\Middleware\User;

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
<<<<<<< HEAD
<<<<<<< HEAD
        ]);
        //adding multi roles authentication (below are middleware class not model class)
        //these key('admin', etc) are passed into web.php or routes
        // Add the 'google' middleware group with appropriate middleware
        $middleware->alias([
=======
        ])
        //adding multi roles authentication (below are middleware class not model class)
        //these key('admin', etc) are passed into web.php or routes
        ->alias([
>>>>>>> parent of b5c8065 (auth google and capcha)
=======
        ])
        //adding multi roles authentication (below are middleware class not model class)
        //these key('admin', etc) are passed into web.php or routes
        ->alias([
>>>>>>> parent of b5c8065 (auth google and capcha)
            'admin' => Admin::class,
            'eventadmin' => EventAdmin::class,
            'user' => User::class,
            'panelis' => Panelis::class,
        ]);
<<<<<<< HEAD
<<<<<<< HEAD
        $middleware->group('google', [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class, // Optional, uncomment if needed
            RedirectIfAuthenticated::class . ':google',
            SubstituteBindings::class, // Ensures route model binding works within the group
        ]);
=======

>>>>>>> parent of b5c8065 (auth google and capcha)
=======

>>>>>>> parent of b5c8065 (auth google and capcha)
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
