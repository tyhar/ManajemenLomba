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
        ]);
        //adding multi roles authentication
        $middleware->alias([
            'admin' => Admin::class,
            'eventadmin' => EventAdmin::class,
            'user' => User::class,
            'panelis' => Panelis::class,
        ]);

        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
