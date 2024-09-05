<?php

use App\Http\Middleware\CanViewPostMiddleware;
use App\Http\Middleware\IsAdminMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->web(
        //     \App\Http\Middleware\CanViewPostMiddleware::class, to applay it on the whole pages
        // );

        $middleware->alias(['can-view-post' => CanViewPostMiddleware::class]); // but with this one i need to applay it manully
        $middleware->alias(['is_admin' => IsAdminMiddleware::class]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
